import $ from 'jquery';

class Like {
    constructor() {
        this.events();
    }

    events() {
        $(".like-box").on("click", this.ourClickDispatcher.bind(this))
    }

    //methods
    ourClickDispatcher(e){
        /*sometimes the user will click on the heart icon or on the number 1.*/
        var currentLikeBox = $(e.target).closest(".like-box");

        if(currentLikeBox.data('exists') == 'yes') {
            this.deleteLike();
        } else {
            this.createLike();
        }
    }

    createLike(){
        console.log('create like')
    }

    deleteLike(){
        console.log('delete like')
    }
}

export default Like;