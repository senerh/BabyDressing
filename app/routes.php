<?php

use BabyDressing\Domain\Produit;
use BabyDressing\Domain\Panier;
use BabyDressing\Domain\Categorie;
use BabyDressing\Domain\User;
use BabyDressing\Form\Type\UserType;
use BabyDressing\Form\Type\ProfilType;

use Symfony\Component\HttpFoundation\Request;

// Home page
$app->get('/', function () use ($app) 
{
	//
    $categories = $app['dao.categorie']->findAllCategorie();
    //
    return $app['twig']->render('index.html.twig', array('categories' => $categories));
});

// Detailed info about a product
$app->get('/produit/{id}', function ($id) use ($app) {
    $produit = $app['dao.produit']->find($id);
    //
	$categories = $app['dao.categorie']->findAllCategorie();
	//
	$nomCategorie = $app['dao.produit']->findCategoryName($id);
	$nomAuteur = $app['dao.produit']->findAuteur($id);
	
	if ($app['security']->getToken() and $app['security']->isGranted('IS_AUTHENTICATED_FULLY'))
	{
		$isOrdered = $app['dao.panier']->articleExistant($app['security']->getToken()->getUser()->getId(), $id);
	
		return $app['twig']->render('produit.html.twig', array('categories' => $categories, 'produit' => $produit, 'nomCategorie' => $nomCategorie, 'nomAuteur' => $nomAuteur, 'isOrdered' => $isOrdered));
	}
	else
	{
		return $app['twig']->render('produit.html.twig', array('categories' => $categories, 'produit' => $produit, 'nomCategorie' => $nomCategorie, 'nomAuteur' => $nomAuteur));
	}
})->bind('produit');

// all products by categorie
$app->get('/categorie/{id}', function ($id) use ($app) {
	//
	$categories = $app['dao.categorie']->findAllCategorie();
	//
	if ($id === 'toutes')
	{
		$produits = $app['dao.produit']->findAll();
		$nomCategorie = 'Tous les produits';
	}
	else
	{
		$produits = $app['dao.produit']->findByCategorie($id);
		$nomCategorie = $app['dao.categorie']->find($id);
		$nomCategorie = $nomCategorie->getNom();
	}
    return $app['twig']->render('categorie.html.twig', array('categories' => $categories, 'produits' => $produits, 'nomCategorie' => $nomCategorie));
});

// Detailed info the web site
$app->get('/information', function () use ($app) {
	//
	$categories = $app['dao.categorie']->findAllCategorie();
	//
    return $app['twig']->render('information.html.twig', array('categories' => $categories));
});

// nous contacter
$app->get('/nous-contacter', function () use ($app) {
	//
	$categories = $app['dao.categorie']->findAllCategorie();
	//
    return $app['twig']->render('nouscontacter.html.twig', array('categories' => $categories));
});

// Login form
$app->get('/login', function(Request $request) use ($app) {
	//
	$categories = $app['dao.categorie']->findAllCategorie();
    //
    return $app['twig']->render('login.html.twig', array(
        'error'         => $app['security.last_error']($request),
        'last_username' => $app['session']->get('_security.last_username'),
        'categories' => $categories
    ));
})->bind('login');  // named route so that path('login') works in Twig templates


// ajout au panier
$app->get('/panier/ajouter/{user_id}/{prod_id}', function ($user_id, $prod_id) use ($app) {
	//
	$categories = $app['dao.categorie']->findAllCategorie();
	//
	if (!$app['dao.panier']->articleExistant($user_id, $prod_id))
	{
		$app['dao.panier']->addProduct($user_id, $prod_id);
		$app['session']->getFlashBag()->add('panier', 'Le produit a bien été ajouté au panier.');
	}
	else
	{
		$app['session']->getFlashBag()->add('panier_error', 'Vous avez déja ce produit dans votre panier!');
	}
    return $app->redirect($app["url_generator"]->generate("produit", array('id' => $prod_id)));
});

// retrait au panier
$app->get('/panier/enlever/{user_id}/{prod_id}', function ($user_id, $prod_id) use ($app) {
	//
	$categories = $app['dao.categorie']->findAllCategorie();
	//
	if ($app['dao.panier']->articleExistant($user_id, $prod_id))
	{
		$app['dao.panier']->removeProduct($user_id, $prod_id);
		$app['session']->getFlashBag()->add('panier', 'Le produit a bien été enlevé du panier.');
	}
	else
	{
		$app['session']->getFlashBag()->add('panier_error', 'Impossible d\'enlever ce produit du panier !');
	}
    return $app->redirect($app["url_generator"]->generate("produit", array('id' => $prod_id)));
});

// Le panier
$app->get('/monpanier/{id}', function ($id) use ($app) {
	//
	$categories = $app['dao.categorie']->findAllCategorie();
	//
	$produits = $app['dao.panier']->findProductsByUser($id);
	$prix = $app['dao.panier']->totalPanier($id);
    return $app['twig']->render('Panier.html.twig', array('categories' => $categories, 'produits' => $produits, 'prix' => $prix));
});

//vider le panier
$app->get('/panier/{id}', function ($id) use ($app) {
	//
	$categories = $app['dao.categorie']->findAllCategorie();
	//
	$prix = $app['dao.panier']->totalPanier($id);
	$date = date("Y-m-d");
	$app['dao.achat']->addAchat($id, $prix, $date);
	$app['dao.panier']->supprimerPanier($id);
	
	$produits = $app['dao.panier']->findProductsByUser($id);
	$prix = $app['dao.panier']->totalPanier($id);
    return $app['twig']->render('Panier.html.twig', array('categories' => $categories, 'produits' => $produits, 'prix' => $prix));
});


// Add a user
$app->match('/inscription', function(Request $request) use ($app) {
	//
	$categories = $app['dao.categorie']->findAllCategorie();
	//
    $user = new User();
    $userForm = $app['form.factory']->create(new UserType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
    	if($app['dao.user']->loadUserByUsername($user->getUsername()))
    	{
    		$app['session']->getFlashBag()->add('danger', 'Un utilisateur existe deja avec cette adresse');
    	}
    	else
    	{
    		// generate a random salt value
       		$salt = substr(md5(time()), 0, 23);
        	$user->setSalt($salt);
        	$plainPassword = $user->getPassword();
        	// find the default encoder
        	$encoder = $app['security.encoder.digest'];
        	// compute the encoded password
        	$password = $encoder->encodePassword($plainPassword, $user->getSalt());
        	$user->setPassword($password); 
        	$app['dao.user']->save($user);
        	$app['session']->getFlashBag()->add('success', 'The user was successfully created.');
    	
    	}
        
    }
    return $app['twig']->render('User_Form.html.twig', array(
        'title' => 'Inscription',
        'userForm' => $userForm->createView(),
        'categories' => $categories));
});

// Edit an existing user
$app->match('/modification_utilisateur/{id}', function($id, Request $request) use ($app) {
	//
	$categories = $app['dao.categorie']->findAllCategorie();
	//
    $user = $app['dao.user']->find($id);
    $userForm = $app['form.factory']->create(new ProfilType(), $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) { 
        $app['dao.user']->save($user);
        $app['session']->getFlashBag()->add('success', 'The user was succesfully updated.');
    }
    return $app['twig']->render('User_Profil.html.twig', array(
        'title' => 'Modification utilisateur',
        'userProfil' => $userForm->createView(),
        'categories' => $categories));
});


//affiche le profil
$app->match('/Commande/{id}', function($id, Request $request) use ($app) {
	//
	$categories = $app['dao.categorie']->findAllCategorie();
	//
    $achats = $app['dao.achat']->findByUser($id);
    $nombre = $app['dao.achat']->NbAchat($id);

    
    return $app['twig']->render('commande.html.twig', array(
        'categories' => $categories, 'achats' => $achats, 'nombre' => $nombre));
});