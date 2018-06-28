import $ from 'jquery';

class Search {
    //1. describe and create/initiate our object
    constructor() {
        this.resultsDiv = $("#search-overlay__results");
        this.openButton = $(".js-search-trigger");
        this.closeButton = $(".search-overlay__close");
        this.searchOverlay = $(".search-overlay");
        this.searchField = $("#search-term");
        this.isOverlayOpen = false;
        this.isSpinnerVisible = false;
        this.previousValue;
        this.typingTimer;
        this.events();
    }

    //2. events
    events(){
        this.openButton.on('click', this.openOverlay.bind(this));
        this.closeButton.on('click', this.closeOverlay.bind(this));
        this.searchField.on("keyup", this.typingLogic.bind(this));
        $(document).on("keydown",this.keyPressDispatcher.bind(this));


    }

    //3. methods
    typingLogic(){
        if(this.searchField.val() != this.previousValue) {
            clearTimeout(this.typingTimer);
            console.log("search field val: ", this.searchField.val())
            if (this.searchField.val()){
                if (!this.isSpinnerVisible){
                    this.resultsDiv.html('<div class="spinner-loader"></div>')
                    this.isSpinnerVisible = true;
                }
                this.typingTimer = setTimeout(this.getResults.bind(this), 500);
            } else {
                console.log('emptying results')
                this.resultsDiv.html("");
                this.isSpinnerVisible = false;
            }

        }
        this.previousValue = this.searchField.val();
    }

    getResults(){
        $.getJSON('http://fictional-university.local/wp-json/wp/v2/posts?search=' + this.searchField.val(),(posts) => {
            console.log(posts[0].title.rendered)
        })
        this.isSpinnerVisible = false;
    }

    keyPressDispatcher(e){

        if(e.keyCode == 83 && !this.isOverlayOpen && !$("input, textarea").is(":focus")){
            this.openOverlay();
        } else if(e.keyCode == 27 && this.isOverlayOpen){
            this.closeOverlay();
        }
    }

    openOverlay(){
        this.searchOverlay.addClass("search-overlay--active");
        this.isOverlayOpen = true
        $("body").addClass("body-no-scroll");

    }

    closeOverlay(){
        this.searchOverlay.removeClass("search-overlay--active");
        this.isOverlayOpen = false;
        $("body").removeClass("body-no-scroll");
    }
}

//this allows us to import the code into other script files
export default Search;