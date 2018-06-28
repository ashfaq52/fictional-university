import $ from 'jquery';

class Search {
    //1. describe and create/initiate our object
    constructor() {
        this.openButton = $(".js-search-trigger");
        this.closeButton = $(".search-overlay__close");
        this.searchOverlay = $(".search-overlay");
        this.isOverlayOpen = false;
        this.events();
    }

    //2. events
    events(){
        this.openButton.on('click', this.openOverlay.bind(this));
        this.closeButton.on('click', this.closeOverlay.bind(this));
        $(document).on("keydown",this.keyPressDispatcher.bind(this));

    }

    //3. methods
    keyPressDispatcher(e){

        if(e.keyCode == 83 && !this.isOverlayOpen){
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