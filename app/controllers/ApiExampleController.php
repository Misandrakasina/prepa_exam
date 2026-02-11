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
    public function getObjets()
    {
        try {
            $objets = $this->db()->fetchAll("
                SELECT o.id_objet as id, 
                o.prix_estime as price,
                o.image_path as image,
                u.name as userName,
                u.email as userEmail,
                c.nom as category
                FROM objets o
                JOIN users u ON o.id_user = u.id
            ");
        } catch (Exception $e) {
            // Si o.id n'existe pas, utiliser ROW_NUMBER
            $objets = $this->db()->fetchAll("
                SELECT 
                    ROW_NUMBER() OVER o(ORDER BY o.id_user, o.prix_estime) as id,
                    o.prix_estime as price,
                    o.image_path as image,
                    u.name as userName,
                    u.email as userEmail,
                    c.nom as category
                FROM objets o
                JOIN users u ON o.id_user = u.id
                JOIN categories c ON o.id_categorie = c.id
                ORDER BY o.id_user, o.prix_estime
            ");
        }
        $this->app->json($objets);
    }
}