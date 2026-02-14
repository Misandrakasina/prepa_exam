<?php

namespace app\controllers;

use flight\Engine;

class ApiExampleController
{
    protected Engine $app;

    public function __construct(Engine $app)
    {
        $this->app = $app;
    }

    private function db()
    {
        return $this->app->db();
    }

    // ====================== LOGIN ======================
    public function login()
    {
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true) ?? [];

        $email = trim($data['email'] ?? '');

        if ($email === '') {
            $this->app->json(['success' => false, 'message' => 'Email requis'], 400);
            return;
        }

        $user = $this->db()->fetchRow(
            "SELECT id, name, email FROM users WHERE email = ?",
            [$email]
        );

        if ($user) {
            $this->app->json([
                'success'  => true,
                'message'  => 'Connexion réussie',
                'user'     => $user,
                'redirect' => '/dashboard'   // ← Important
            ]);
        } else {
            $this->app->json(['success' => false, 'message' => 'Email non trouvé'], 401);
        }
    }

    // ====================== Autres routes ======================
    public function getUsers()
    {
        $users = $this->db()->fetchAll("SELECT id, name, email FROM users ORDER BY id");
        $this->app->json($users);
    }

    public function getUser($id)
    {
        $user = $this->db()->fetchRow(
            "SELECT id, name, email FROM users WHERE id = ?",
            [(int)$id]
        );

        if ($user) {
            $this->app->json($user);
        } else {
            $this->app->json(['error' => 'Utilisateur non trouvé'], 404);
        }
    }

    public function updateUser($id)
    {
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true) ?? [];

        $name  = trim($data['name'] ?? '');
        $email = trim($data['email'] ?? '');

        if ($name === '' && $email === '') {
            $this->app->json(['success' => false, 'message' => 'Aucune donnée'], 400);
            return;
        }

        $updates = [];
        $params  = [];

        if ($name !== '')  { $updates[] = "name = ?";  $params[] = $name; }
        if ($email !== '') { $updates[] = "email = ?"; $params[] = $email; }

        $params[] = (int)$id;

        $query = "UPDATE users SET " . implode(', ', $updates) . " WHERE id = ?";
        $affected = $this->db()->run($query, ...$params);

        if ($affected > 0) {
            $this->app->json(['success' => true, 'message' => 'Mis à jour', 'id' => (int)$id]);
        } else {
            $this->app->json(['success' => false, 'message' => 'Aucune modification'], 404);
        }
    }

    // ====================== Objets/Produits ======================

    /**
     * Récupère tous les objets groupés par utilisateur
     * GET /api/objets-par-utilisateur
     */
    public function getObjetsByUser()
    {
        try {
            $objets = $this->db()->fetchAll("
                SELECT o.id_objet AS id,
                       o.prix_estime AS price,
                       o.image_path AS image,
                       o.id_user,
                       u.name AS userName,
                       u.email AS userEmail,
                       c.nom AS category
                FROM objets o
                JOIN users u ON o.id_user = u.id
                JOIN categories c ON o.id_categorie = c.id
                ORDER BY u.name, o.id_objet
            ");

            // Grouper les objets par utilisateur
            $result = [];
            foreach ($objets as $objet) {
                $userId = $objet['id_user'];
                if (!isset($result[$userId])) {
                    $result[$userId] = [
                        'user' => [
                            'id'    => (int) $userId,
                            'name'  => $objet['userName'],
                            'email' => $objet['userEmail'],
                        ],
                        'objets' => [],
                    ];
                }
                $result[$userId]['objets'][] = [
                    'id'       => (int) $objet['id'],
                    'price'    => (float) $objet['price'],
                    'image'    => $objet['image'],
                    'category' => $objet['category'],
                ];
            }

            $this->app->json([
                'success' => true,
                'data'    => array_values($result),
            ]);
        } catch (\Exception $e) {
            $this->app->json([
                'success' => false,
                'message' => 'Erreur lors de la récupération des objets : ' . $e->getMessage(),
            ], 500);
        }
    }
}