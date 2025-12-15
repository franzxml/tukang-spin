<?php

/**
 * Class Flasher
 *
 * Manages flash messages (notifications) using PHP Sessions.
 * Refactored to output clean HTML for Apple-style toast notifications.
 *
 * @package App\Core
 */
class Flasher
{
    public static function setFlash(string $message, string $action, string $type): void
    {
        $_SESSION['flash'] = [
            'message' => $message,
            'action'  => $action,
            'type'    => $type
        ];
    }

    public static function flash(): void
    {
        if (isset($_SESSION['flash'])) {
            $type = $_SESSION['flash']['type'];
            $icon = ($type == 'success') 
                ? '<svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>'
                : '<svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>';

            // Output clean HTML structure for styling
            echo '<div class="flash-toast type-' . $type . '">';
            echo '  <div class="flash-icon">' . $icon . '</div>';
            echo '  <div class="flash-content">';
            echo '      <span class="flash-title">' . $_SESSION['flash']['message'] . '</span>';
            echo '      <span class="flash-desc">' . ucfirst($_SESSION['flash']['action']) . '</span>';
            echo '  </div>';
            echo '</div>';
            
            unset($_SESSION['flash']);
        }
    }
}