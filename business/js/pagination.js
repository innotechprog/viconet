        let currentPage = 1;
        console.log(totalPages);

        function generatePagination() {
            const paginationContainer = document.getElementById('pagination-container');
            paginationContainer.innerHTML = '';

            const maxTabs = 5;
            const startPage = Math.max(1, currentPage - Math.floor(maxTabs / 2));
            const endPage = Math.min(totalPages, startPage + maxTabs - 1);

            for (let i = startPage; i <= endPage; i++) {
                const paginationItem = document.createElement('button');
                paginationItem.className = 'pagination-item page-btn';
                paginationItem.innerText = i;

                if (i === currentPage) {
                    paginationItem.classList.add('active');
                }

                paginationItem.addEventListener('click', () => {
                    console.log(`Clicked on page ${i}`);
                    currentPage = i;
                    generatePagination();
                });

                paginationContainer.appendChild(paginationItem);
            }

            const container = document.getElementById('pagination-container');
            container.scrollLeft = paginationContainer.querySelector('.active').offsetLeft - container.clientWidth / 2 + paginationContainer.querySelector('.active').clientWidth / 2;
        }

        generatePagination(); // Initial generation

        // Add event listeners for pagination buttons
        document.querySelector('.start-page').addEventListener('click', () => {
            currentPage = 1;
            generatePagination();
        });

        document.querySelector('.prev-page').addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                generatePagination();
            }
        });

        document.querySelector('.next-page').addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                generatePagination();
            }
        });

        document.querySelector('.end-page').addEventListener('click', () => {
            currentPage = totalPages;
            generatePagination();
        });