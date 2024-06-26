# Refactoring Kata Test

## Introduction

Let's say we are a company specialized in merchandise transport in different countries, and we have some message templates we want to send
in different languages. To do that, we've developed `TemplateManager` whose job is to replace
placeholders in texts by travel related information.

`TemplateManager` is a class that's been around for years and nobody really knows who coded
it or how it really works. Nonetheless, as the business changes frequently, this class has
already been modified many times, making it harder to understand at each step.

Today, once again, the PO wants to add some new stuff to it and add the management for a new
placeholder. But this class is already complex enough and just adding a new behaviour to it
won't work this time.

Your mission, should you decide to accept it, is to **refactor `TemplateManager` to make it
understandable by the next developer** and easy to change afterwards. Now is the time for you to
show your exceptional skills and make this implementation better, extensible, and ready for future
features.

Sadly for you, the public method `TemplateManager::getTemplateComputed` is called everywhere, 
and **you can't change its signature**. But that's the only one you can't modify (unless explicitly
forbidden in a code comment), **every other class is ready for your changes**.

This exercise **was made to not last longer than 1 hour** but we know that this can be too short to do it all and
you might take longer if you want. Stop when you feel you've done something you feel comfortable sharing with us.

You can run the example file to see the method in action.

## Rules
There are some rules to follow:
 - You must commit regularly
 - You must not modify code when comments explicitly forbid it

## Deliverables
What do we expect from you:
 - the link of the git repository
 - several commits, with an explicit message each time
 - a file / message / email explaining your process and principles you've followed

**Good luck!**

## MES EXPLICATIONS
- `workflow GIT`
    - REPOS GIT : 
    - branch main (contient le projet initial)
    - branch develop
    - creation feature depuis develop
    - pull request sur develop
- PR : `https://github.com/ldridi/lesechos.fr/pull/1`
  - Refactorisation de `TemplateManager` pour améliorer la maintenabilité et l'extensibilité
  - Séparation des responsabilités : création des classes `QuotePlaceholderReplacer` et `UserPlaceholderReplacer` pour gérer le remplacement des placeholders spécifiques à chaque contexte.
  - Utilisation du principe d'injection de dépendance dans TemplateManager pour permettre l'ajout de nouveaux types de placeholders sans modifier le code existant.
  - Mise à jour de example.php pour démontrer l'utilisation du nouveau `TemplateManager` avec les placeholders.
- PR : `https://github.com/ldridi/lesechos.fr/pull/2` (ajout une evolution pour tester l'extensibilité)
  - Ajouter l'entité `Purchase` et le placeholders
    - Ajout de la nouvelle entité Purchase pour représenter les données d'achat.
    - Purchase.php contient les propriétés `id`, `token `Le constructeur initialise `id`, `token`.
    - Implémentation de `PurchasePlaceholderReplacer` pour gérer les placeholders spécifiques aux achats.
    - `PurchasePlaceholderReplacer.php` implémente l'interface PlaceholderReplacer.
    - Remplace `[purchase:token]` dans le texte du template.
    - Mise à jour de example.php pour démontrer l'utilisation de `PurchasePlaceholderReplacer`.
    - Inclusion de la nouvelle entité `Purchase` et de `PurchasePlaceholderReplacer`.
    - Ajout de données d'exemple pour `Purchase` dans l'appel de la méthode `getTemplateComputed`.
    - Le template inclut maintenant le placeholder `[purchase:token]` pour montrer la nouvelle fonctionnalité.
    - Assure que `TemplateManager` peut gérer le nouveau remplaçant de placeholders.
    - Modification de `TemplateManager` pour accepter un tableau d'instances de `PlaceholderReplacer`.