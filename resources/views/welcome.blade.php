<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Welcome Page</title>
   <style>
      body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
         background-color: #f0f0f0;
      }

      .container {
         max-width: 600px;
         margin: 100px auto;
         padding: 20px;
         background-color: #fff;
         border-radius: 10px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      h1 {
         text-align: center;
         color: #333;
      }

      p {
         color: #666;
      }

      a {
         color: #007bff;
         text-decoration: none;
      }

      a:hover {
         text-decoration: underline;
      }
   </style>
</head>

<body>

   <div class="container">
      <p>Data Provinsi</p>
      <a href="/search/provinces" target="_blank">/search/provinces</a>
      <p>Data Provinsi Berdasarkan ID</p>
      <a href="/search/provinces?id=1" target="_blank">/search/provinces?id=1</a>
      <hr>
      <p>Data Kota/Kabupaten</p>
      <a href="/search/cities" target="_blank">/search/cities</a>
      <p>Data Kota/Kabupaten Berdasarkan ID</p>
      <a href="/search/cities?id=1" target="_blank">/search/cities?id=1</a>
      <p>Data Kota/Kabupaten Berdasarkan Provinsi ID</p>
      <a href="/search/cities?province_id=1" target="_blank">/search/cities?province_id=1</a>
      <hr>
      <p>Untuk merubah pengambilan data dari Raja Ongkir</p>
      <a href="/data-source?from=raja-ongkir" target="_blank">Raja Ongkir</a>
      <p>Untuk merubah pengambilan data dari Database Lokal</p>
      <a href="/data-source?from=local" target="_blank">Lokal</a>
   </div>

</body>

</html>