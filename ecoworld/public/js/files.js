var input = document.querySelectorAll('.file__field');

Array.prototype.forEach.call( input, function( input )
{
    var label = input.nextElementSibling

    label.addEventListener("click", () => {
        $('.file__field').trigger('click');
    });
});
