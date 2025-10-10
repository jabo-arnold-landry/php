<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <title>Document</title>
</head>
<body>
  <header class="flex flex-wrap items-center justify-between px-5 py-4  bg-linear-to-r from-neutral-700 to-neutral-950 text-white relative">
    <h1 class="font-bold text-white text-2xl uppercase text-balance">match results</h1>
    <section class="popup">
      <button class="bg-indigo-900 text-white text-center px-4 py-1 rounded-sm capitalize hover:bg-indigo-700 cursor-pointer" onclick="showPopup()" id="popup-btn">&plus; add results</button>
    </section>
  </header>
    <div class="bg-black opacity-[0.5] fixed inset-0 z-10" onclick="hidePopup()" id="overlay" hidden></div>
    <div class="relative flex items-center justify-center z-20 @container" hidden id="form-container">
          <form action="insert.php" method="post" class="absolute bg-linear-to-t from-neutral-900 to-neutral-950 text-white mt-40 mx-4 px-4 py-3 rounded-md grid gap-5 @md:mt-20">
            <div class="grid @md:flex flex-wrap @md:items-center gap-2 ">
              <input type="text" name="team-a" placeholder="team a" class="border border-neutral-400 px-2.5 py-1.5 rounded-sm">
              <input type="text" name="team-a-scores" placeholder="team a scores" class="border border-neutral-400 px-2.5 py-1.5 rounded-sm">
            </div>

            <div class="grid @md:flex flex-wrap @md:items-center gap-2 ">
              <input type="text" name="team-b" placeholder="team b" class="border border-neutral-400 px-2.5 py-1.5 rounded-sm">
              <input type="text" name="team-b-scores" placeholder="team b scores" class="border border-neutral-400 px-2.5 py-1.5 rounded-sm">
            </div>
            <button name="submit" type="submit" class="capitalize col-span-full justify-self-center bg-indigo-900 text-white text-center px-4 py-1 rounded-sm hover:bg-indigo-700 cursor-pointer @md:justify-self-start">publish</button>
          </form>
        </div>
  <main class="fixtures">
    <h2>fixtures</h2>
    <section class="grid gap-4 mx-4">
      <?php
      require_once 'select_matches.php';
      $matches = getMatches();
      if (!empty($matches)) {
                foreach($matches as $match) {
                    echo "<div class='bg-linear-to-l from-indigo-900 from-20% to-neutral-900 text-white flex gap-4 justify-around items-center py-2 px-1 rounded-md'>
                            <p class='capitalize font-bold text-xl'>{$match['team_a']}</p>
                            <div class='font-extra-bold'>
                                <span>{$match['team_a_score']} :</span>
                                <span>{$match['team_b_score']}</span>
                            </div>
                            <p class='capitalize font-bold text-xl'>{$match['team_b']}</p>
                          </div>";
                }
            } else {
                echo "<p class='text-center text-gray-500'>No matches found</p>";
            }
            ?>
    </section>
  </main>
  <script src="./javascript/main.js"></script>
</body>
</html>
