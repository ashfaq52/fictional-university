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

        if(currentLikeBox.attr('data-exists') == 'yes') {
            console.log('deleting like')
            this.deleteLike(currentLikeBox);
        } else {
            this.createLike(currentLikeBox);
        }
    }

    createLike(currentLikeBox){

        $.ajax({
            //need this otherwise Wordpress will deny our request
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            type: 'POST',
            data: {'professorId' : currentLikeBox.data('professor')},
            success: (response) => {
                //change the heart to be filled in
                currentLikeBox.attr('data-exists', 'yes');
                //update the heart number
                var likeCount = parseInt(currentLikeBox.find(".like-count").html(), 10);
                likeCount++;
                currentLikeBox.find(".like-count").html(likeCount);

                currentLikeBox.attr("data-like", response);
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }

    deleteLike(currentLikeBox){
        console.log('inside the deleteLike log function')
        $.ajax({
            //need this otherwise Wordpress will deny our request
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/university/v1/manageLike',
            //gets the ID for the relevant like post.
            data: {'like': currentLikeBox.attr('data-like')},
            type: 'DELETE',
            success: (response) => {
                /*TODO: THE CODE BELOW DOESN'T SEEM TO BE WORKING. IT'S SUPPOSED TO CONTROL THE HEART ANIMATIONS
                BUT NOTHING IS HAPPENING WHEN WE UNLIKE*/
                //change the heart to be empty
                currentLikeBox.attr('data-exists', 'no');
                //update the heart number
                var likeCount = parseInt(currentLikeBox.find(".like-count").html(), 10);
                likeCount--;
                currentLikeBox.find(".like-count").html(likeCount);

                currentLikeBox.attr("data-like", '');
                console.log('testing: '+ response);
            },
            error: (response) => {
                console.log(response);
            }
        });
    }
}

export default Like;