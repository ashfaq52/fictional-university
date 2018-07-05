import $ from 'jquery';

class MyNotes {
    constructor(){
        this.events();
        console.log('this is active')
    }

    events(){
        $(".delete-note").on("click", this.deleteNote)
        $(".edit-note").on("click", this.editNote)
    }

    //Methods will go here
    editNote(e){
        var thisNote = $(e.target).parents("li");
        thisNote.find(".note-title-field, .note-body-field").removeAttr("readonly").addClass("note-active-field");
        thisNote.find(".update-note").addClass("update-note--visible");

    }

    deleteNote(e){
        console.log('clicked delete!')
        //see page-my-notes.php (should be line 29)
        var thisNote = $(e.target).parents("li")
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
            type: 'DELETE',
            success: (response) => {
                //removes the element from the page using a nice animation
                thisNote.slideUp();
                console.log("Congrats you MOFO you finally figured out what when wrong!!! omfg");
                console.log(response);
            },
            error: (response) => {
                console.log("Sorry");
                console.log(response);
            },

        })
    }
}

export default MyNotes;