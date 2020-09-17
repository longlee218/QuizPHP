<?php include_once './MVC/Views/inc/master.php'?>
<body>
    <div class="container">
        This is exam


        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>


        <div id="demo"></div>
    </div>

</body>

<script>
    $('#demo').pagination()

    $('#demo').pagination({
        dataSource: [1, 2, 3, 4, 5, 6, 7, ... , 195],
    callback: function(data, pagination) {
        // template method of yourself
        var html = template(data);
        dataContainer.html(html);
    }
    })


    function getDetail() {
        const segment_str = window.location.pathname;
        const segment_array = segment_str.split( '/' );
        segment_array.splice(0,4);
        return segment_array;
    }
    var id_quiz =  getDetail()[0];

    $.ajax({
        type: 'GET',
        url: '/../QuizSys/APIThread/queryQuizPaginator/'+id_quiz+'/1',
        headers: {
            'Content-type': 'application/json',
            'Authorization': getCookie('Authorization')
        },
        success: (data) =>{
            console.log(data);

        },
        error: (xhr, error) => {
            console.log(xhr, error);
        }
    })


</script>