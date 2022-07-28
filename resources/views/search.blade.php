<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mariage</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
 

<style>
    @import url('https://fonts.googleapis.com/css?family=Krub:400,700');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html, body {
  width: 100%;
  height: 100%;
}

body {
  background: orange;
  font-family: 'Krub', sans-serif;
}

.card {
  position: absolute;
  margin: auto;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  width: 250px;
  height: 400px;
  border-radius: 10px;
  box-shadow: 0 10px 25px 5px rgba(0, 0, 0, 0.2);
  background: white;
  overflow: hidden;
  .ds-top {
    position: absolute;
    margin: auto;
    top: 0;
    right: 0;
    left: 0;
    width: 300px;
    height: 80px;
    background: crimson;
    animation: dsTop 1.5s;
  }
  .avatar-holder {
    position: absolute;
    margin: auto;
    top: 40px;
    right: 0;
    left: 0;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    box-shadow: 0 0 0 5px #151515,
                inset 0 0 0 5px #000000,
                inset 0 0 0 5px #000000,
                inset 0 0 0 5px #000000,
                inset 0 0 0 5px #000000,;
    background: white;
    overflow: hidden;
    animation: mvTop 1.5s;
    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }
  .name {
    position: absolute;
    margin: auto;
    top: -60px;
    right: 0;
    bottom: 0;
    left: 0;
    width: inherit;
    height: 40px;
    text-align: center;
    animation: fadeIn 2s ease-in;
    a {
      color: white;
      text-decoration: none;
      font-weight: 700;
      font-size: 18px;
        &:hover {
          text-decoration: underline;
          color: crimson;
      }
    }
    h6 {
      position: absolute;
      margin: auto;
      left: 0;
      right: 0;
      bottom: 0;
      color: white;
      width: 40px;
    }
  }
  .button {
    position: absolute;
    margin: auto;
    padding: 8px;
    top: 20px;
    right: 0;
    bottom: 0;
    left: 0;
    width: inherit;
    height: 40px;
    text-align: center;
    animation: fadeIn 2s ease-in;
    outline: none;
    a {
      padding: 5px 20px;
      border-radius: 10px;
      color: white;
      letter-spacing: 0.05em;
      text-decoration: none;
      font-size: 10px;
      transition: all 1s;
      &:hover {
        color: white;
        background: crimson;
      }
    }
  }
  .ds-info {
    position: absolute;
    margin: auto;
    top: 120px;
    bottom: 0;
    right: 0;
    left: 0;
    width: inherit;
    height: 40px;
    display: flex;
    .pens, .projects, .posts {
      position: relative;
      left: -300px;
      width: calc(250px / 3);
      text-align: center;
      color: white;
      animation: fadeInMove 2s;
      animation-fill-mode: forwards;
      h6 {
        text-transform: uppercase;
        color: crimson;
      }
      p {
        font-size: 12px;
      }
    }
    .ds {
      &:nth-of-type(2) {
        animation-delay: .5s;
      }
      &:nth-of-type(1) {
        animation-delay: 1s;
      }
    }
  }
  .ds-skill {
    position: absolute;
    margin: auto;
    bottom: 10px;
    right: 0;
    left: 0;
    width: 200px;
    height: 100px;
    animation: mvBottom 1.5s;
    h6 {
      margin-bottom: 5px;
      font-weight: 700;
      text-transform: uppercase;
      color: crimson;
    }
    .skill {
      h6 {
        font-weight: 400;
        font-size: 8px;
        letter-spacing: 0.05em;
        margin: 4px 0;
        color: white;
      }
      .fab {
        color: crimson;
        font-size: 14px;
      }
      .bar {
        height: 5px;
        background: crimson;
        text-align: right;
        p {
          color: white;
          font-size: 8px;
          padding-top: 5px;
          animation: fadeIn 5s;
        }
        &:hover {
          background: white;
        }
      }
      .bar-html {
        width: 95%;
        animation: htmlSkill 1s;
        animation-delay: .4s;
      }
      .bar-css {
        width: 90%;
        animation: cssSkill 2s;
        animation-delay: .4s;
      }
      .bar-js {
        width: 75%;
        animation: jsSkill 3s;
        animation-delay: .4s;
      }
    }
  }
}

@keyframes fadeInMove {
  0% {
    opacity: 0;
    left: -300px;
  }
  100% {
    opacity: 1;
    left: 0;
  }
}

@keyframes fadeIn {
  0% {opacity: 0;}
  100% {opacity: 1;}
}

@keyframes htmlSkill {
  0% {width: 0;}
  100% {width: 95%;}
}

@keyframes cssSkill {
  0% {width: 0;}
  100% {width: 90%;}
}

@keyframes jsSkill {
  0% {width: 0;}
  100% {width: 75%;}
}

@keyframes mvBottom {
  0% {bottom: -150px;}
  100% {bottom: 10px;}
}

@keyframes mvTop {
  0% {top: -150px;}
  100% {top: 40px;}
}

@keyframes dsTop {
  0% {top: -150px;}
  100% {top: 0;}
}

.following {
  color: white;
  background: crimson;
}

</style>


    <!-- <div class="card">
  <div class="ds-top"></div> -->
<div class="container">
  <div class="row">
  @if($search)
   <div class="name overflow-auto ">
    @foreach($search as $s)
    <div class="bg-warning">
      <h4 class="  text-secondary">Nom:</h4>
      <p  class="p-3 mb-2 bg-success text-white">{{$s->name}}</p>
      <h4 class="text-secondary">Fonction:</h4>
      <p  class="p-3 mb-2 bg-success text-white">{{$s->function}}</p>
      <h4 class="text-secondary">Table:</h4>
      <p class="p-3 mb-2 bg-success text-white">{{$s->table_name}}</p>
    </div>
   
    @endforeach
  </div>
   @else
    <p>not found</p>

    @endif
  </div>
</div>
  

 
 
    <!-- </div> -->
</body>
</html>



