import $ from 'jquery/dist/jquery'

class MyNotes{
    constructor(){
        //alert("Hello from MyNotes.js")
        this.events()
    }

    events(){
        $(".delete-note").on("click", this.deleteNote.bind(this))
    }

    // Methods will go here
    deleteNote(){
        alert("You clicked delete");
    }

}

export default MyNotes