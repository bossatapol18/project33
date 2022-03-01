<input type="hidden" id="option">
<button role="button" data-toggle="modal" data-target="#selectModal">
    Select an Option
</button>
<span id="optionName"></span>
<script>
    $(option).on('click', function () {
    $('#option').val($(this).attr('value'));
    $('#optionName').text($(this).text());
    $('#selectModal').modal('hide');
});
</script>