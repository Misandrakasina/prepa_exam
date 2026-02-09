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

    // ────────────────────────────────────────────────
    // POST /api/login – Vérification + redirection vers dashboard
    // ────────────────────────────────────────────────
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
            // Connexion réussie → on renvoie une redirection vers le dashboard
            $this->app->json([
                'success'  => true,
                'message'  => 'Connexion réussie',
                'user'     => [
                    'id'    => $user['id'],
                    'name'  => $user['name'],
                    'email' => $user['email']
                ],
                'redirect' => '/'  // ← vers le dashboard (qui charge index.php)
            ]);
        } else {
            $this->app->json(['success' => false, 'message' => 'Email non trouvé'], 401);
        }
    }

    // ────────────────────────────────────────────────
    // GET /api/users – Liste tous les utilisateurs
    // ────────────────────────────────────────────────
    public function getUsers()
    {
        $users = $this->db()->fetchAll("SELECT id, name, email FROM users ORDER BY id");
        $this->app->json($users);
    }

    // ────────────────────────────────────────────────
    // GET /api/users/@id – Un utilisateur spécifique
    // ────────────────────────────────────────────────
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

    // ────────────────────────────────────────────────
    // POST /api/users/@id – Mise à jour
    // ────────────────────────────────────────────────
    public function updateUser($id)
    {
        $raw = file_get_contents('php://input');
        $data = json_decode($raw, true) ?? [];

        $name  = trim($data['name']  ?? '');
        $email = trim($data['email'] ?? '');

        if ($name === '' && $email === '') {
            $this->app->json(['success' => false, 'message' => 'Aucune donnée à mettre à jour'], 400);
            return;
        }

        $updates = [];
        $params  = [];

        if ($name !== '') {
            $updates[] = "name = ?";
            $params[]  = $name;
        }
        if ($email !== '') {
            $updates[] = "email = ?";
            $params[]  = $email;
        }

        $params[] = (int)$id;

        $query = "UPDATE users SET " . implode(', ', $updates) . " WHERE id = ?";
        $affected = $this->db()->run($query, ...$params);

        if ($affected > 0) {
            $this->app->json(['success' => true, 'message' => 'Utilisateur mis à jour', 'id' => (int)$id]);
        } else {
            $this->app->json(['success' => false, 'message' => 'Utilisateur non trouvé ou rien changé'], 404);
        }
    }
}