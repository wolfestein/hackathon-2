## Exercice du Niveau E

La compression avec perte d'informations permet de générer
  des hashs (clé unique (généralement courte) qui permet d'identifier de manière unique un objet).

Ici nous avons mis en place un mécanisme qui permet de générer un hash (une empreinte) qui permet
  d'identifier une image rapidement à partir d'un hash sur 12 caractères.

L'avantage de la technique de compression / hashage présentée, c'est qu'elle permettra de savoir
  si des images sont proches deux à deux en ayant à manipuler uniquement leurs empreintes (12 caractères)
  plutôt que des manipuler des images qui ont potentiellement des millions d'informations (pixel, métas, ...)

L'objectif de l'exercice est de compléter le hash générer en rajoutant un code en fonction de la
  couleur dominante de l'image.