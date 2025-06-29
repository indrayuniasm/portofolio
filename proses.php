<?php
session_start();
if (!isset($_SESSION['login'])) {
    die("Akses ditolak.");
}

$title = htmlspecialchars($_POST['title']);
$image = htmlspecialchars($_POST['image']);
$desc  = htmlspecialchars($_POST['desc']);
$link  = htmlspecialchars($_POST['link']);
$repo  = htmlspecialchars($_POST['repo']);

$newProject = <<<HTML
<article class="bg-white rounded-lg shadow p-6 flex flex-col sm:flex-row gap-6 cursor-pointer hover:shadow-lg transition">
  <img src="$image" alt="$title" class="rounded-lg w-full sm:w-48 object-cover" />
  <div>
    <h3 class="text-xl font-semibold mb-2">$title</h3>
    <p class="text-gray-700 mb-3">$desc</p>
    <a class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 font-semibold text-lg" href="$link" target="_blank" rel="noopener noreferrer">
      <i class="fa fa-chrome text-xl"></i> cek disini
    </a>
    <a class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 font-semibold text-lg mt-3 block" href="$repo" target="_blank" rel="noopener noreferrer">
      <i class="fa fa-github-square text-xl"></i> ambil kode
    </a>
  </div>
</article>
HTML;

$indexFile = 'index.html';
$html = file_get_contents($indexFile);

if (preg_match('/<div class="space-y-8 max-w-4xl mx-auto" id="projectsList">(.*?)<\/div>/s', $html, $matches)) {
    $existingProjects = trim($matches[1]);
    $updated = $existingProjects . "\n" . $newProject;
    $newHtml = preg_replace(
        '/<div class="space-y-8 max-w-4xl mx-auto" id="projectsList">.*?<\/div>/s',
        "<div class=\"space-y-8 max-w-4xl mx-auto\" id=\"projectsList\">\n$updated\n</div>",
        $html
    );

    file_put_contents($indexFile, $newHtml);
    header('Location: admin.php');
    exit;
} else {
    echo "Gagal menambahkan. Struktur index.html tidak ditemukan.";
}
