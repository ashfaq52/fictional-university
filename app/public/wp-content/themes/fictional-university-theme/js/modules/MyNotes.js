import $ from 'jquery';

class MyNotes {
    constructor(){

    }

    events(){
        this.events
        $(".delete-note").on("click", this.deleteNote)
    }

    //Methods will go here
    deleteNote(){
        $.ajax({
            beforeSend: () => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/wp/v2/note/99',
            type: 'DELETE',
            success: () => {
                console.log("Congrats");
                console.log(response);
            },
            error: () => {
                console.log("Sorry");
                console.log(response);
            },

        })
    }
}

export default MyNotes;