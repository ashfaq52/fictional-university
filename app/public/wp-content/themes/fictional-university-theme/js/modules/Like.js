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
        $.ajax({
            url: universityData.rout_url + '/wp-json/univeristy/v1/manageLike',
            type: 'POST',
            success: (response) => {
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }

    deleteLike(){
        $.ajax({
            url: universityData.rout_url + '/wp-json/univeristy/v1/manageLike',
            type: 'DELETE',
            success: (response) => {
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }
}

export default Like;