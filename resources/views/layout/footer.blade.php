</div>

<!-- If you prefer jQuery these are the required scripts -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
<script script src="{{ asset('assets') }}/js/vendor.js"></script>
<script src="{{ asset('assets') }}/js/adminx.js"></script>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('[data-table]').DataTable({});

        /* $('.form-control-search').keyup(function(){
          table.search($(this).val()).draw() ;
        }); */
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>

<script>
    document.getElementById('export-btn').addEventListener('click', function() {
        // Get table
        var table = document.querySelector('table');

        // Convert table to Excel workbook
        var wb = XLSX.utils.table_to_book(table, {
            sheet: "Sheet JS"
        });

        // Convert workbook to binary string
        var wbout = XLSX.write(wb, {
            bookType: 'xlsx',
            type: 'binary'
        });

        // Save as Excel file
        function s2ab(s) {
            var buf = new ArrayBuffer(s.length);
            var view = new Uint8Array(buf);
            for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
            return buf;
        }

        saveAs(new Blob([s2ab(wbout)], {
            type: "application/octet-stream"
        }), 'report.xlsx');
    });
</script>

<script type="text/javascript">
    function currentTime() {
        var date = new Date(); /* creating object of Date class */
        var hour = date.getHours();
        var min = date.getMinutes();
        var sec = date.getSeconds();
        var midday = "AM";
        midday = hour >= 12 ? "PM" : "AM"; /* assigning AM/PM */
        hour = hour == 0 ? 12 : hour > 12 ? hour - 12 : hour; /* assigning hour in 12-hour format */
        hour = changeTime(hour);
        min = changeTime(min);
        sec = changeTime(sec);
        document.getElementById("digit_clock_time").innerText = hour + " : " + min + " : " + sec + " " +
        midday; /* adding time to the div */

        var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
            "November", "Desember"
        ];
        var days = ["Minggu", "senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

        var curWeekDay = days[date.getDay()]; // get day
        var curDay = date.getDate(); // get date
        var curMonth = months[date.getMonth()]; // get month
        var curYear = date.getFullYear(); // get year
        var date = curWeekDay + ", " + curDay + " " + curMonth + " " + curYear; // get full date
        document.getElementById("digit_clock_date").innerHTML = date;

        var t = setTimeout(currentTime, 1000); /* setting timer */
    }

    function changeTime(k) {
        /* appending 0 before time elements if less than 10 */
        if (k < 10) {
            return "0" + k;
        } else {
            return k;
        }
    }

    currentTime();
</script>

<!-- If you prefer vanilla JS these are the only required scripts -->
<!-- script src="./dist/js/vendor.js"></script>
    <script src="./dist/js/adminx.vanilla.js"></script-->
</body>

</html>
