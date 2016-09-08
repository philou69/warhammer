/**
 * Created by philippe on 06/09/16.
 */
var collectionHolder;

// setup an "add a photo" link
var $addPhotoLink = $('<a href="#" class="add_photo_link btn btn-default btn-xs">Ajouter une photo</a>');
var $newLinkLi = $('<li></li>').append($addPhotoLink);


    // get the ul that holds the collection of photo
    $collectionHolder = $('ul.photos');

    // add a delete link to all of the existing photo form li elements
    $collectionHolder.find('li').each(function()
    {
        addPhotoFormDeleteLink($(this));
    })

    // add the "add a photo" anchor and li to the photos ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have, use that as the new
    // index when inserting a new item
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addPhotoLink.on('click', function(e) {
        // prevent the link from creating a '#' on the url
        e.preventDefault();

        // add a new tag form (see next code block)
        addPhotoForm($collectionHolder, $newLinkLi);
    })

    function addPhotoForm($collectionHolder, $newLinkLi) {
        // Get the data-prototype explained earlier
        var prototype = $collectionHolder.data('prototype');

        // get the new index
        var index = $collectionHolder.data('index');

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newForm = prototype.replace(/__name__label__/g,"Photo "+(index+1)).replace(/__name__/g,index);

        // increase the index with one for the next items
        $collectionHolder.data('index', index + 1);

        // display the form in the page in and li, before the "Add a photo" link li
        var $newFormLi = $('<li></li>').append(newForm);
        $newLinkLi.before($newFormLi);

        // add a delete link to the new form
        addPhotoFormDeleteLink($newFormLi);
    }

    function addPhotoFormDeleteLink($photoFormLi)
    {
        var $removeFormA= $('<a href="#" class="btn btn-danger btn-xs">Supprimer cette photo</a>');
        $photoFormLi.append($removeFormA);

        $removeFormA.on('click', function(e) {
            // prevent the link from creating a "#" on the url
            e.preventDefault();

            // remove the li for the photo Form
            $photoFormLi.remove();
        })
    }
