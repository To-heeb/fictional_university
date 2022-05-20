import $ from 'jquery/dist/jquery'

class Like {
    constructor(){
       this.events()
    }

    // events
    events(){   
        $(".like-box").on("click", this.ourClickDispatcher.bind(this))
    }

    // methods
    ourClickDispatcher(e){
        var currentLikeBox = $(e.target).closest(".like-box")
        if (currentLikeBox.data('exists') == 'yes') {
            this.deleteLike();
        } else {
            this.createLike()
        }
    }

    createLike(){
        alert("Create Like")
    }

    deleteLike(){
        alert("Delete like")
    }
}

export default Like