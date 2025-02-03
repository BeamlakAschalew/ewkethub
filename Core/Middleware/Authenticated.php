<?php

namespace Core\Middleware;

class Authenticated {
    public function handle() {
        if (! $_SESSION['student'] ?? false) {
            redirect('/login');
        }
    }
}
