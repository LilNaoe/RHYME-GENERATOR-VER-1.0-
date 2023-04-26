<?php
class RhymeBrain {
  private $maxResults;
  private $apiUrl;

  public function __construct($maxResults = 50) {
    $this->maxResults = $maxResults;
    $this->apiUrl = 'https://rhymebrain.com/talk?function=getRhymes&maxResults=' . $maxResults . '&word=';
  }

  public function getMaxResults() {
    return $this->maxResults;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RhymeBrain</title>
  <style>
    body {
  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
  background-color: #222;
  color: #eee;
}

form {
  display: flex;
  justify-content: center;
  margin: 20px 0;
}

input[type="text"] {
  padding: 10px;
  font-size: 18px;
  border: 2px solid #ccc;
  border-radius: 4px;
  width: 300px;
  margin-right: 10px;
  background-color: #333;
  color: #eee;
}

input[type="submit"] {
  padding: 10px 20px;
  font-size: 18px;
  background-color: #4CAF50;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

#RhymeBrainResults {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  grid-auto-rows: auto;
  grid-gap: 20px;
  margin: 20px;
}

.rhyme-card {
  padding: 10px;
  background-color: #444;
  border: 1px solid #eee;
  border-radius: 5px;
  text-align: center;
}

.rhyme-card {
  margin: 0 auto;
  text-align: center;
  padding: 10px;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  border-radius: 5px;
}
  </style>
</head>
<body>
  <form action="#" onsubmit="return RhymeBrainSubmit()">
    <input type="text" id="RhymeBrainInput">
    <input type="submit" value="Rhyme">
  </form>
  <div id="RhymeBrainResults"></div>
  <script type="text/javascript">
    <?php
  // Define a JavaScript variable that contains the maxResults value from the PHP class
  $rhymeBrain = new RhymeBrain();
  $maxResults = $rhymeBrain->getMaxResults();
  echo "var RhymeBrainMaxResults = $maxResults;\n";
?>
    
    function RhymeBrainSubmit() {
      var input = document.getElementById('RhymeBrainInput').value;
      var apiUrl = 'https://rhymebrain.com/talk?function=getRhymes&maxResults=' + RhymeBrainMaxResults + '&word=' + encodeURIComponent(input);
      var resultsDiv = document.getElementById('RhymeBrainResults');
      resultsDiv.innerHTML = 'Loading...';

      fetch(apiUrl)
        .then(function(response) {
          return response.json();
        })
        .then(function(data) {
          var rhymesHtml = '';
          for (var i = 0; i < data.length; i++) {
            rhymesHtml += '<p>' + data[i].word + '</p>';
          }
          resultsDiv.innerHTML = rhymesHtml;
        })
        .catch(function(error) {
          resultsDiv.innerHTML = 'Error: ' + error.message;
        });

      return false;
    }
  </script>
</body>
</html>