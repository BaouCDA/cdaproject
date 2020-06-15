function onClickBtnLike(event){
    //Pour annuler le changement de page provoqué par le clic
    event.preventDefault();
    //Création des constante
    const url = this.href;
    const spanCount = this.querySelector('span.js-likes');
    const icone = this.querySelector('i');

    //Récuper l'url, effectue la requete et recupere la reponse
    axios.get(url).then(function(response){
      //nombre de likes
      const likes = response.data.likes;
      //Affichage du nombre de likes dans le span correspondant
      spanCount.textContent = likes;
      //Modification du pouce en fonction de sont état
      if(icone.classList.contains('fas'))
      {
        icone.classList.replace('fas','far');
      }else{
        icone.classList.replace('far','fas');
      }
    }).catch(function(error){
      if(error.response.status === 403){
        window.alert("Vous devez etre connecté pour liker !");
      }else{
        window.alerte("Une erreur s'est produite, reesayé plus tard");
      }
    })
  }
  //Apel la fonction onClickBtnLike ci-dessus en cas de clic
  document.querySelectorAll('a.js-like').forEach(function(link){
    link.addEventListener('click', onClickBtnLike);
  })