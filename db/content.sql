--
-- Contenu de la table `categorie`
--
INSERT INTO `categorie` (`cat_id`, `cat_nom`) VALUES
(1, 'Body'),
(2, 'Bonnet'),
(3, 'Chaussettes'),
(4, 'Gants'),
(5, 'Manteau'),
(6, 'Peluche');


--
-- Contenu de la table `Utilisateur`
--
/* raw password is 'john' */
insert into Utilisateur values
(1, 'Doe', 'John', 'JohnDoe@thug.com', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER', null, null, null, null, null);
/* raw password is 'jane' */
insert into Utilisateur values
(2, 'Doe', 'Jane', 'JaneDoe@thug.com', 'EfakNLxyhHy2hVJlxDmVNl1pmgjUZl99gtQ+V3mxSeD8IjeZJ8abnFIpw9QNahwAlEaXBiQUBLXKWRzOmSr8HQ==', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER', null, null, null, null, null);


--
-- Contenu de la table `produit`
--
INSERT INTO `produit` (`prod_id`, `prod_title`, `prod_description`, `prod_image`, `prod_prix`, `cat_id`, user_id) VALUES
(1, 'Body bleu', 'Magnifique body pour bébé de 2 à 3 ans avec inscription sur le ventre.', 'body_bleu.jpg', 7.5, 1, 1),
(2, 'Body superman', 'Pour que votre bébé soit un super héros voici le body idéal.', 'body_superman.jpg', 10, 1, 1),
(3, 'Bonnet bleu', 'Pour les froides journées d''hiver.', 'bonnet_bleu.jpg', 4.5, 2, 1),
(4, 'Chapka', 'Votre bébé sera un petit russe tout chou.', 'bonnet_chapka.jpg', 5.1, 2, 1),
(5, 'Bonnet noah', 'Votre fils s''appelle Noah, voici son futur bonnet !', 'bonnet_noah.jpg', 3.2, 2, 1),
(6, 'Chaussettes bleues', 'Pour que les jolis petits pieds de bébé soient au chaud.', 'chaussettes_bleues.jpg', 4.4, 3, 1),
(7, 'Chaussettes  en laine', 'De grosse chaussettes en laine pour les rudes températures d''hiver.', 'chaussettes_grises.jpg', 4.2, 3, 1),
(8, 'Gants jaunes', 'De jolis gants tricotés par grand mère.', 'gants_jaunes.jpg', 4.8, 4, 2),
(9, 'Gants en fourrures', 'Et les mains de votre bébé seront bien protégées.', 'gants_marrons.jpg', 5.7, 4, 2),
(10, 'Manteau rose', 'Votre fille sera magnifique.', 'manteau_rose.jpg', 15, 5, 2),
(11, 'Peluche elephant', 'Un petit éléphant tout doux pour les nuits calmes de votre bébé.', 'peluche_elephant.jpg', 12.1, 6, 2),
(12, 'Peluche lapin', 'Le lapin de toutes les nuits de votre enfant.', 'peluche_lapin.jpg', 11.99, 6, 2),
(13, 'Peluche luigi', 'Le meilleur ami de Mario devient le meilleur ami de votre fils.', 'peluche_luigi.jpg', 13.1, 6, 2),
(14, 'Peluche pingouin', 'Le plus beau des pingouins pour repousser les cauchemars de votre bébé.', 'peluche_pingouin.jpg', 11.1, 6, 2);

--
-- Contenu de la table panier
--
INSERT INTO `panier` (`prod_id`, `user_id`) VALUES
(1, 1),
(2, 1),
(3, 2);

--
-- Contenu de la table achat
--
INSERT INTO `achat` (`user_id`, `achat_date`,`achat_total`) VALUES
(1, '2015-04-12', 17.4),
(1, '2015-04-21', 22.3),
(2, '2015-05-11', 10.5);