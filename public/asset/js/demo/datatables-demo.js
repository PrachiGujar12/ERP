console.log("jQuery Version:", $.fn.jquery); // This should log the jQuery version

$(document).ready(function() {
    // Function to initialize DataTables with search and scroll options
    function initializeDataTable(tableId) {
        console.log("Initializing DataTable for:", tableId); // Log the table ID being initialized

        $(tableId).DataTable({
            "paging": false,
            "lengthChange": false,
            "info": false,
            "ordering": false,
            "searching": true,
			
            "dom": '<"top"f>rt',
            "scrollY": "40vh",   // Set the height of tbody for vertical scrolling
            "scrollX": true,     // Enable horizontal scrolling
            "scrollCollapse": true, // Allow scrolling only when necessary
            "fixedHeader": true, // Fix the header row
        });
    }

    // Initialize each DataTable
    initializeDataTable('#dataTable');
    initializeDataTable('#dataTable1');
    initializeDataTable('#dataTable2');

    // Redirect to the URL in data-href when a row is clicked
    $('tbody').on('click', 'tr[data-href]', function(event) {
        // Prevent default action if clicking on a link
        if (!$(event.target).closest('a').length) {
            window.location = $(this).data('href');
        }
    });
});
