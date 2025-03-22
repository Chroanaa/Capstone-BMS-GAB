
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay ID</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 20px;
            font-family: Arial, Helvetica, sans-serif;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
          h1, .title-class { display: none !important; }


        .card-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .card {
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }

        @media print {
            body {
                padding: 0;
                background: none;
            }
            
            .card-container {
                margin: 0;
            }

            .bg-primary {
                background-color: #0d6efd !important;
                color: white !important;
            }

            .shadow-sm {
                box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important;
            }

            img {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
             title, header, footer {
        display: none !important;
    }

    /* Hide specific elements if needed */
    .top-right-text, .bottom-text {
        display: none !important;
    }
        }
    </style>
</head>
<body>
    <div class="card-container">
        <div class="card shadow-sm border" style="width: 500px; height: 350px;">
            <div class="card-top bg-primary text-light  fw-bold p-2 d-flex justify-content-center align-items-center">
                <img src="../../assets/img/sinbanali.png" class="img-fluid" style="width: 50px;" alt="">
                <div class="d-flex flex-column align-items-center" style="font-size: .7rem;">
                    <label>REPUBLIC OF THE PHILIPPINES</label>
                    <label>CITY OF BACOOR</label>
                    <label>BARANGAY</label>
                    <label>SINBANALI</label>    
                </div>
                <img src="data:image/jpeg;base64," class="img-fluid" style="width: 50px;" alt="">
            </div>
            <div class="card-mid p-3 d-flex justify-content-start align-items-center" style="flex-grow: 1; gap: 5px;">
                <img src="data:image/jpeg;base64, " class="img-fluid" style="width:200px; height: 150px;" alt="Sample Image">
                <div class="card-info d-flex flex-column" style="font-size: .7rem;">
                <label>Name: </label>
                            <label>Birthday: </label>
                            <label>Gender:  </label>
                            <label>Civil Status: </label>
                    
                </div>
            </div>
            <div class="card-bot px-2 d-flex justify-content-center align-items-center">
                <img src="../../assets/img/service.png" class="img-fluid" style="width: 100px;" alt="">
                <img src="../../assets/img/strike.jpg" class="img-fluid" style="width: 70px;" alt="">
            </div>
        </div>
        <div class="card shadow-sm border p-3" style="width: 500px; height: 350px;">
            <div class="back-top  d-flex" style="flex: 1;">
                <div class=" d-flex  rounded-3 fw-bold justify-content-center align-items-center flex-column text-center" style="flex: 1; font-size: .7rem; border: 1px solid black;">
                    <label>INCASE OF EMERGENCE:</label>
                    <labe>WILLENL. TARONG</labe>
                    <label>374 LABRADOR COMPD. PUROK</label>
                    <label>SINEGUESLASAN, SINBANALI, BACOOR CITY,</label>
                    <label>CAVITE</label>
                    <p>09399194665</p>
                </div>
                <div class="text-center d-flex justify-content-center align-items-center flex-column" style="flex: 1; font-size: .7rem;">
                    <img src="../../assets/img/strike.jpg" class="img-fluid " style="width: 100px;" alt="">
                    <label>Holder is a bonafide constituent of this barangay and is entitled to all privilege and services holder may require.

                        If found please return to the Barangay Secretariat Barangay Hall Bacoor City.</label>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        
      
    </script>
</body>
</html>
