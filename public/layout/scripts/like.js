function onClickBtnLike(event){
    event.preventDefault();
    const url = this.href;
    const spanCount = this.querySelector('span.js-likes');
    //const jaime = this.querySelector('span.js-label');
    const icone = this.querySelector('i');

    axios.get(url).then(function(response){
      //console.log(response);
      const likes = response.data.likes;
      spanCount.textContent = likes;
      if(icone.classList.contains('fas')){
        icone.classList.replace('fas','far');
        //jaime.textContent="j\'aime";
      }else{
        icone.classList.replace('far','fas');
        //jaime.textContent="je n'aime plus ?";
      }
    }).catch(function(error){
      if(error.response.status === 403){
        window.alert("Vous devez etre connecté pour liker !");
      }else{
        window.alerte("Une erreur s'est produite, reesayé plus tard");
      }
    })
  }

  document.querySelectorAll('a.js-like').forEach(function(link){
    link.addEventListener('click', onClickBtnLike);
  })