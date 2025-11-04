# 🎯 Fonctionnalités principales et cas d’utilisation – Projet *Tétouan Créative*

## 🧠 Tableau des fonctionnalités (Méthode MoSCoW)

| Priorité | Fonctionnalité | Description |
|----------|----------------|-------------|
| Must     | Création de profil artiste/artisan | Chaque utilisateur peut créer un profil avec photo, description, spécialité et coordonnées. |
| Must     | Publication d’œuvres | L’artiste/artisan peut publier des images, un titre, une description et une catégorie. |
| Must     | Consultation de la galerie | Les visiteurs peuvent parcourir les créations par catégorie et trier (récent / populaire). |
| Should   | Interaction sociale (likes/commentaires) | Les visiteurs peuvent aimer ou commenter les œuvres pour encourager les créateurs. |
| Should   | Moteur de recherche / filtres | Rechercher par nom, catégorie, ou mot-clé. |
| Could    | Messagerie ou formulaire de contact | Permettre aux visiteurs d’envoyer une demande privée à l’artiste. |
| Won’t    | Vente directe / paiement | Pas inclus dans le MVP (sera envisagé plus tard). |

---

## 💬 Cas d’utilisation (3 à 5 UC)

| ID  | Acteur          | Cas d’utilisation (UC)                                    | Priorité |
|-----|------------------|-----------------------------------------------------------|----------|
| UC1 | Artiste/Artisan  | S’inscrire et créer un profil                              | Must     |
| UC2 | Artiste/Artisan  | Publier une création (image, titre, description, catégorie)| Must     |
| UC3 | Visiteur         | Consulter la galerie des créations                         | Must     |
| UC4 | Visiteur         | Aimer ou commenter une création                            | Should   |
| UC5 | Visiteur         | Contacter un artiste via formulaire/annonce                 | Could    |

---

## 🧭 Mini diagramme (instructions)

```
+-------------------------------+
|    Tétouan Créative App       |
|  (Blog & Galerie Numérique)   |
+-------------------------------+
       /         |         \
      /          |          \
     /           |           \
+-------------+ +---------------+ +-------------------+
| Créer compte| |Publier création| |Consulter galerie|
+-------------+ +---------------+ +-------------------+
      |               |                   |
[Artiste/Artisan] [Artiste/Artisan]   [Visiteur]
                                          |
                                          |
                                +-------------------+
                                | Aimer / Commenter |
                                +-------------------+
                                          |
                                          |
                                +-------------------+
                                |Contacter un artiste|
                                +-------------------+
                                          |
                                      [Visiteur]
```
