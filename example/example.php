<?php

use Faker\Factory;

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../src/Entity/Destination.php';
require_once __DIR__ . '/../src/Entity/Quote.php';
require_once __DIR__ . '/../src/Entity/Site.php';
require_once __DIR__ . '/../src/Entity/Template.php';
require_once __DIR__ . '/../src/Entity/User.php';
require_once __DIR__ . '/../src/Helper/SingletonTrait.php';
require_once __DIR__ . '/../src/Context/ApplicationContext.php';
require_once __DIR__ . '/../src/Repository/Repository.php';
require_once __DIR__ . '/../src/Repository/DestinationRepository.php';
require_once __DIR__ . '/../src/Repository/QuoteRepository.php';
require_once __DIR__ . '/../src/Repository/SiteRepository.php';
require_once __DIR__ . '/../src/Helper/PlaceholderReplacer.php';
require_once __DIR__ . '/../src/Helper/QuotePlaceholderReplacer.php';
require_once __DIR__ . '/../src/Helper/UserPlaceholderReplacer.php';
require_once __DIR__ . '/../src/TemplateManager.php';

$faker = Factory::create();

$template = new Template(
    1,
    '<i>Votre livraison à [quote:destination_name]</i><br><hr>',
    "
            Bonjour [user:first_name],
            <br>Merci de nous avoir contacté pour votre livraison à [quote:destination_name].
            <br>Bien cordialement,
            <br>L'équipe de Shipper
");

// Initialiser les placeholders
$quoteReplacer = new QuotePlaceholderReplacer();
$userReplacer = new UserPlaceholderReplacer();

// Initialiser le TemplateManager
$templateManager = new TemplateManager([$quoteReplacer, $userReplacer]);

// Calculer avec les données fournies
$message = $templateManager->getTemplateComputed(
    $template,
    [
        'quote' => new Quote($faker->randomNumber(), $faker->randomNumber(), $faker->randomNumber(), $faker->date()),
        'user' => new User($faker->randomNumber(), $faker->firstName, $faker->lastName, $faker->email)
    ]
);

echo $message->subject . "\n" . $message->content;
