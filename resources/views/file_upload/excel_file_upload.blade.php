<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax file request</title>
</head>

<body>
    <div>
        <input type="file" id="file_upload" name="file_upload">
    </div>
    <div id="setRenameField"></div>
    <div>
        <button title="Add" onclick="fileUploadSubmit(this)">
            Upload
        </button>
    </div>

    <script>
        const BASE_URL = 'http://127.0.0.1:8000/';
        var sendHttpRequestFile = (method, url, data) => {
            console.log(data)
            return fetch(url, {
                method: method,
                body: data,
                headers: data ?
                    {
                        Accept: "application/json"
                    } :
                    {},
            }).then((response) => {
                console.log(response);
                if (response.status >= 400) {
                    // !response.ok
                    return response.json().then((errResData) => {
                        var error = new Error("Something went wrong!");
                        error.data = errResData;
                        throw error;
                    });
                }
                return response.json();
            });
        };

        function fileUploadSubmit(input) {
            var file_upload = document.getElementById("file_upload");
            if (file_upload.files[0] == undefined) {
                alert("You didn't select File");
                return;
            }
            var fd = new FormData();
            fd.append("excel_file_upload", file_upload.files[0]);
            fd.append("_token", "{{ csrf_token() }}");

            sendHttpRequestFile(
                    "POST",
                    BASE_URL +
                    `add-excel-file-to-server-store`, fd
                )
                .then((responseData) => {
                    console.log(responseData);
                })
                .catch((err) => {
                    console.log(err, err.data);
                });
        }

    </script>
</body>

</html>
