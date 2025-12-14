<?php

/**
 * Class Flasher
 *
 * Manages flash messages (notifications) using PHP Sessions.
 * Used to display success or error messages after an action (e.g., CRUD operations).
 *
 * @package App\Core
 */
class Flasher
{
    /**
     * Sets a flash message to be displayed on the next request.
     *
     * @param string $message The message body (e.g., "Data successfully added").
     * @param string $action The action performed (e.g., "added", "deleted").
     * @param string $type The alert type (e.g., "success", "danger", "warning").
     * @return void
     */
    public static function setFlash(string $message, string $action, string $type): void
    {
        $_SESSION['flash'] = [
            'message' => $message,
            'action'  => $action,
            'type'    => $type
        ];
    }

    /**
     * Displays the flash message if it exists, then clears it from the session.
     *
     * @return void
     */
    public static function flash(): void
    {
        if (isset($_SESSION['flash'])) {
            echo '<div style="background-color: var(--bg-secondary); border-left: 4px solid ' . ($_SESSION['flash']['type'] == 'success' ? '#4e7cff' : '#ff4e4e') . '; color: var(--text-primary); padding: 15px; margin-bottom: 20px; border-radius: 4px; display: flex; justify-content: space-between; align-items: center;">';
            echo '<span>Data <strong>' . $_SESSION['flash']['message'] . '</strong> ' . $_SESSION['flash']['action'] . '.</span>';
            echo '<button onclick="this.parentElement.style.display=\'none\';" style="background:none; border:none; color:inherit; cursor:pointer; font-size:1.2rem;">&times;</button>';
            echo '</div>';
            
            unset($_SESSION['flash']);
        }
    }
}