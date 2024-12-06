<?php

echo "WELCOME TO PYTHON E-NOTE SYSTEM\n";
echo "Options:\n";
echo "1) Generate Note\n";
echo "2) View Notes\n";
echo "3) Exit\n";
echo "Enter your choice: ";

// Get user input for choice
$handle = fopen("php://stdin", "r");
$choice = trim(fgets($handle));

// File path to store notes
$notesFile = 'notes.json';

// Load existing notes from the file
$notes = file_exists($notesFile) ? json_decode(file_get_contents($notesFile), true) : [];

// Handle user choice
switch ($choice) {
    case 1:
        echo "Generate a New Note\n";

        // Validate name input
        do {
            echo "Enter your name: ";
            $name = trim(fgets($handle));
            if (empty($name)) {
                echo "Error: Name cannot be empty. Please try again.\n";
            } elseif (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
                echo "Error: Name can only contain letters. Please try again.\n";
                $name = ""; // Reset the name if invalid
            }
        } while (empty($name));

        // Validate title input
        do {
            echo "Enter the title of the note: ";
            $title = trim(fgets($handle));
            if (empty($title)) {
                echo "Error: Title cannot be empty. Please try again.\n";
            }
        } while (empty($title));

        // Validate content input
        do {
            echo "Enter the content of the note: ";
            $content = trim(fgets($handle));
            if (empty($content)) {
                echo "Error: Content cannot be empty. Please try again.\n";
            }
        } while (empty($content));

        // Add note to the array
        $notes[] = [
            'name' => $name,
            'title' => $title,
            'content' => $content
        ];

        // Save notes to the file
        file_put_contents($notesFile, json_encode($notes, JSON_PRETTY_PRINT));

        echo "Note generated successfully!\n";
        break;

    case 2:
        if (empty($notes)) {
            echo "No notes available.\n";
        } else {
            echo "Viewing All Notes:\n";
            foreach ($notes as $note) {
                echo "----------------------\n";
                echo "Name: " . $note['name'] . "\n";
                echo "Title: " . $note['title'] . "\n";
                echo "Content: " . $note['content'] . "\n";
            }
            echo "----------------------\n";
        }
        break;

    case 3:
        echo "Exiting the system. Goodbye!\n";
        break;

    default:
        echo "Invalid choice selected. Please try again.\n";
        break;
}

fclose($handle);
?>
