# Projet Sessions : Gestion des Apprenants et des Sessions de Formation

Ce projet est une application web CRUD développée en PHP avec le framework Symfony. Elle permet de gérer le suivi des apprenants et des sessions de formation.

## Fonctionnalités

- Visualisation des informations des apprenants.
- Visualisation des détails des sessions de formation.
- Ajout et suppression de profils d'apprenants.
- Inscription et désinscription des apprenants aux sessions de formation.
- Ajout et suppression de sessions de formation.
- Programmation et retrait des unités de formation pour créer le programme.

## Utilisation

### Gestion des Apprenants
- Ajouter un apprenant: Naviguez vers la section liste des apprenants et cliquez sur "Ajouter un apprenant". Remplissez le formulaire et soumettez-le.
- Supprimer un apprenant: Dans le détail d'un apprenant que vous souhaitez retirer, cliquez sur "Supprimer".
- Éditer un apprenant : Dans le détail de l'apprenant que vous souhaitez éditer, cliquer sur "Éditer". Modifier les informations nécessaires.

### Gestion des Sessions de Formation
- Ajouter une session: Naviguez vers la section des sessions et cliquez sur "Ajouter une session". Remplissez le formulaire et soumettez-le.
- Supprimer une session: Dans la liste des sessions, cliquez sur "Supprimer" à côté de la session que vous souhaitez retirer. 
- Éditer une session: Dans le détail de la session que vous souhaitez éditer, cliquer sur "Éditer". Modifier les informations nécessaires.
- Inscrire un apprenant : Dans le détail de la session concernée, sélectionner le nom de l'apprenant que vous voulez inscrire et cliquer sur le bouton "+"
- Désinscrire un apprenant : Dans le détail de la session concernée, sélectionner le nom de l'apprenant que vous voulez désinscrire et cliquer sur le bouton "-"

### Gestion des Programmes de Formation
- Programmer une unité de formation: Allez dans le détail d'une session et ajoutez des unités de formation selon vos besoins en cliquant sur "+".
- Retirer une unité de formation: Dans le détail d'une session, cliquez sur "-" à côté de l'unité que vous souhaitez supprimer.


## Technologies Utilisées

- PHP avec Symfony: Framework PHP pour le développement d'applications web.
- Base de données: HeidiSQL pour la gestion de la base de données.
- Frontend: Bootstrap et Bootswatch pour la mise en forme et le design de l'application.
