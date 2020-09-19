
(function ($){
    const baseUrl = window.location.origin;

    let unselectedItemSelected = false;
    let unselectedItemId = null;
    let selectedItemSelected = false;
    let selectedItemId = null;

    const unselectedItemsSection = document.querySelector('#unselected-items-section');
    const unselectedListItem = document.querySelectorAll('.unselected-list-item');

    const selectedItemsSection = document.querySelector('#selected-items-section');
    const selectedListItem = document.querySelectorAll('.selected-list-item');

    const moveSelectedListBtn = document.querySelector('.move-selected-list-btn');
    const moveUnselectedListBtn = document.querySelector('.move-unselected-list-btn');

    const addItemForm = document.getElementById('addItemForm');

    const moveItemHandler = (itemId, isSelected) => {

        const formData = new FormData();
        formData.append('is_selected', isSelected);
        formData.append('_method', 'PATCH');

        const url = baseUrl + '/items/'+ itemId +'/move';

        axios
            .post(url, formData)
            .then(({data}) => {
                alert('Item moved Successfully');
                location.reload();
            })
            .catch(error => {
                const validate_error = error.response.data[0].message;
                alert(validate_error);
            });
    };

    $(addItemForm).submit(function (e) {
        e.preventDefault();

        const submitButton = addItemForm.querySelector('button[type=submit]')
        submitButton.setAttribute('disabled','true');

        const formData = new FormData(addItemForm);

        axios
            .post(baseUrl + '/items', formData)
            .then(({data}) => {
                alert('Item Added Successfully');
                location.reload();
            })
            .catch(error => {
                if (error.response.status === 422) {
                    const validate_error = error.response.data.errors['item_name'][0];
                    alert(validate_error);
                } else {
                    const validate_error = error.response.data[0].message;
                    alert(validate_error);
                }
            })
            .finally(() => submitButton.removeAttribute('disabled'));
    });

    unselectedItemsSection.addEventListener('click', function (e) {
        e.preventDefault();

        unselectedListItem.forEach(function myFunction(element)
        {
            element.classList.contains('item-selected') ? element.classList.remove('item-selected') : null;
        });

        if ( e.target.classList.contains('unselected-list-item') )
        {
            moveSelectedListBtn.removeAttribute('disabled');

            unselectedItemSelected = true;
            unselectedItemId = e.target.getAttribute('data-id');

            e.target.classList.add('item-selected');
        }
    });

    selectedItemsSection.addEventListener('click', function (e) {
        e.preventDefault();

        selectedListItem.forEach(function myFunction(element)
        {
            element.classList.contains('item-selected') ? element.classList.remove('item-selected') : null;
        });

        if ( e.target.classList.contains('selected-list-item') )
        {
            moveUnselectedListBtn.removeAttribute('disabled');

            selectedItemSelected = true;
            selectedItemId = e.target.getAttribute('data-id');

            e.target.classList.add('item-selected');
        }
    });

    moveUnselectedListBtn.addEventListener('click', function (e) {
       e.preventDefault();

       if ( !selectedItemSelected ) return false;

       moveItemHandler(selectedItemId, 0);

    });

    moveSelectedListBtn.addEventListener('click', function (e) {
        e.preventDefault();

        if ( !unselectedItemSelected ) return false;

        moveItemHandler(unselectedItemId, 1);

    });

})(jQuery);
