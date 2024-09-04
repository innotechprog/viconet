const fromDate = document.getElementById('fromDate');
        const toDate = document.getElementById('toDate');
        const filterButton = document.getElementById('filterButton');
        const error = document.getElementById('error');

        const setMaxDate = () => {
            const today = new Date().toISOString().split('T')[0];
            toDate.setAttribute('max', today);
        };

        const generateFilteredData = (from, to) => {
            // This function should be implemented to fetch and filter the data based on the date range.
            // For demonstration purposes, we'll use dummy data.
            const data = [
                { value: '1', text: 'Data 1', date: '2023-06-15' },
                { value: '2', text: 'Data 2', date: '2023-07-01' },
                { value: '3', text: 'Data 3', date: '2023-07-10' },
                // Add more data as needed
            ];

            return data.filter(item => item.date >= from && item.date <= to);
        };

        const validateDates = () => {
            const from = fromDate.value;
            const to = toDate.value;
            const today = new Date().toISOString().split('T')[0];
            if (from && to && (to < from || to > today)) {
                error.style.display = 'block';
                return false;
            } else {
                error.style.display = 'none';
                return true;
            }
        };

        fromDate.addEventListener('change', validateDates);
        toDate.addEventListener('change', validateDates);

        filterButton.addEventListener('click', () => {
            if (validateDates()) {
                const from = fromDate.value;
                const to = toDate.value;

                if (from && to) {
                    const filtered = generateFilteredData(from, to);

                    // Process the filtered data as needed
                    //console.log('Filtered Data:', filtered);
                    // For example, you could update a table or display the data in another way
                } else {
                   // alert('Please select both From Date and To Date.');
                }
            }
        });

        // Set the max date for the To Date input to today
        setMaxDate();