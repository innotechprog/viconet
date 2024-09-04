<!-- results.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results Page</title>
    <style>
        #pagination {
            display: flex;
            list-style: none;
            padding: 0;
            overflow: auto;
            white-space: nowrap;
        }

        .pagination-item {
            margin: 0 5px;
            cursor: pointer;
            display: inline-block;
        }

        .pagination-item.active {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="pagination-container">
        <ul id="pagination"></ul>
    </div>

    <script>
        const totalPages = 10; // Replace with your total number of pages
        let currentPage = 1; // Initialize with your current page

        function generatePagination() {
            const paginationContainer = document.getElementById('pagination');
            paginationContainer.innerHTML = '';

            const maxTabs = 5;
            const startPage = Math.max(1, currentPage - Math.floor(maxTabs / 2));
            const endPage = Math.min(totalPages, startPage + maxTabs - 1);

            for (let i = startPage; i <= endPage; i++) {
                const paginationItem = document.createElement('li');
                paginationItem.className = 'pagination-item';
                paginationItem.innerText = i;

                if (i === currentPage) {
                    paginationItem.classList.add('active');
                }

                paginationItem.addEventListener('click', () => {
                    // Handle pagination item click, e.g., navigate to the selected page
                    // For now, let's just log the clicked page
                    console.log(`Clicked on page ${i}`);
                    currentPage = i;
                    generatePagination(); // Regenerate pagination based on the new current page
                });

                paginationContainer.appendChild(paginationItem);
            }

            // Scroll to the clicked tab
            const container = document.getElementById('pagination-container');
            container.scrollLeft = paginationContainer.querySelector('.active').offsetLeft - container.clientWidth / 2 + paginationContainer.querySelector('.active').clientWidth / 2;
        }

        // Call the function to generate pagination
        generatePagination();
    </script>
</body>
</html>
