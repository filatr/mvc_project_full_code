<?php
/**
 * ACL — перевірка дозволів
 */

require_once ROOT_PATH . '/core/Database.php';

class Acl
{
    /**
     * Перевіряє, чи має користувач дозвіл
     */
    public static function can(string $permission): bool
    {
        if (!isset($_SESSION['user'])) {
            return false;
        }

        $db = Database::getInstance()->getConnection();

        $sql = "
            SELECT COUNT(*) FROM role_permissions rp
            JOIN roles r ON r.id = rp.role_id
            JOIN permissions p ON p.id = rp.permission_id
            WHERE r.name = :role AND p.code = :permission
        ";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            'role' => $_SESSION['user']['role'],
            'permission' => $permission
        ]);

        return $stmt->fetchColumn() > 0;
    }

    /**
     * Жорстка перевірка з 403
     */
    public static function require(string $permission): void
    {
        if (!self::can($permission)) {
            http_response_code(403);
            echo 'Недостатньо прав';
            exit;
        }
    }
}
