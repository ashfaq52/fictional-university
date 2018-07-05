import $ from 'jquery';

class MyNotes {
    constructor(){
        this.events();
        console.log('this is active')
    }

    events(){
        /*
        Explanation of line of code below: whenever you click anywhere within the parent unordered list (#my-notes)
        if the actual interior element you clicked on matches ".delete-note", fire the callback method
        */
        $("#my-notes").on("click", ".delete-note", this.deleteNote)
        $("#my-notes").on("click", ".edit-note", this.editNote.bind(this))
        $("#my-notes").on("click", ".update-note", this.updateNote.bind(this))
        $(".submit-note").on("click", this.createNote.bind(this))


    }

    //Methods will go here
    editNote(e){
        console.log('clicked on edit note')
        var thisNote = $(e.target).parents("li");
        if (thisNote.data('state') == "editable") {
            this.makeNoteReadOnly(thisNote);
        } else {
            this.makeNoteEditable(thisNote);
        }
    }

    makeNoteEditable(thisNote){
        thisNote.find(".edit-note").html('<i class="fa fa-times" aria-hidden="true"></i> Cancel');
        thisNote.find(".note-title-field, .note-body-field").removeAttr("readonly").addClass("note-active-field");
        thisNote.find(".update-note").addClass("update-note--visible");
        thisNote.data("state", "editable");
    }

    makeNoteReadOnly(thisNote){
        thisNote.find(".edit-note").html('<i class="fa fa-pencil" aria-hidden="true"></i> Edit');
        thisNote.find(".note-title-field, .note-body-field").attr("readonly", "readonly").removeClass("note-active-field");
        thisNote.find(".update-note").removeClass("update-note--visible");
        thisNote.data("state", "cancel");
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

    updateNote(e){
        console.log('clicked save!')
        //see page-my-notes.php (should be line 29)
        var thisNote = $(e.target).parents("li")
        var ourUpdatedPost = {
            'title': thisNote.find(".note-title-field").val(),
            'content': thisNote.find(".note-body-field").val(),
        }
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/wp/v2/note/' + thisNote.data('id'),
            type: 'POST',
            data: ourUpdatedPost,
            success: (response) => {
                this.makeNoteReadOnly(thisNote)
                console.log("Congrats you MOFO you finally figured out what when wrong!!! omfg");
                console.log(response);
            },
            error: (response) => {
                console.log("Sorry");
                console.log(response);
            },
        })
    }

    createNote(e){
        var ourNewPost = {
            'title': $(".new-note-title").val(),
            'content': $(".new-note-body").val(),
            'status': 'publish',
        }
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', universityData.nonce);
            },
            url: universityData.root_url + '/wp-json/wp/v2/note/',
            type: 'POST',
            data: ourNewPost,
            success: (response) => {
                //empties the form
                $(".new-note-title, .new-note-body").val('');
                //dynamically add new item to list
                $(`
                <li data-id="${response.id}">
                    <input readonly class="note-title-field" value="${response.title.raw}">
                    <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</span>
                    <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</span>
                    <textarea readyonly class="note-body-field">${response.content.raw}
                    </textarea>
                    <span class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right" aria-hidden="true"></i> Save</span>
                </li>
                `).prependTo('#my-notes').hide().slideDown();
            },
            error: (response) => {
                console.log("Sorry there was an error completing your request: ");
                console.log(response);
            },

        })
    }
}

export default MyNotes;