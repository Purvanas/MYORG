<?php

echo "Test de connexion MySQL...\n\n";

// Test avec 127.0.0.1
echo "1. Test avec 127.0.0.1:\n";
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=myorg', 'myorg', 'myrog');
    echo "   ✓ Connexion réussie avec 127.0.0.1 !\n";
} catch (PDOException $e) {
    echo "   ✗ Erreur avec 127.0.0.1: " . $e->getMessage() . "\n";
}

// Test avec localhost
echo "\n2. Test avec localhost:\n";
try {
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=myorg', 'myorg', 'myrog');
    echo "   ✓ Connexion réussie avec localhost !\n";
} catch (PDOException $e) {
    echo "   ✗ Erreur avec localhost: " . $e->getMessage() . "\n";
}

// Test avec l'URL complète
echo "\n3. Test avec DATABASE_URL complète:\n";
$url = "mysql://myorg:myrog@127.0.0.1:3306/myorg?serverVersion=8.0&charset=utf8mb4";
$parts = parse_url($url);
try {
    $dsn = sprintf(
        "mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4",
        $parts['host'],
        $parts['port'],
        ltrim($parts['path'], '/')
    );
    $pdo = new PDO($dsn, $parts['user'], $parts['pass']);
    echo "   ✓ Connexion réussie avec l'URL complète !\n";
} catch (PDOException $e) {
    echo "   ✗ Erreur avec l'URL complète: " . $e->getMessage() . "\n";
}

