var current_date = new Date();
current_date.setDate(current_date.getDate() + 1);

$( ".date" ).datepicker({
    inline: true,
    minDate: current_date
});
