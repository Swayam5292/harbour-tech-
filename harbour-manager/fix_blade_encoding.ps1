# fix_blade_encoding.ps1
# Re-encodes welcome.blade.php and cleans up all mojibake symbols
# Run from: c:\Users\swaya\OneDrive\Documents\harbour-tech\harbour-manager\

$filePath = ".\resources\views\welcome.blade.php"

$content = [System.IO.File]::ReadAllText($filePath, [System.Text.Encoding]::GetEncoding(1252))

$replacements = @{
    "â€""     = "--"
    "â‚¹"     = "&#8377;"
    "â†'"     = "&#8594;"
    "â€¢"     = "&bull;"
    "âœ…"     = "&#10003;"
    "âœ•"     = "&#10005;"
    "âŒ"      = "&#10007;"
    "âš ï¸"   = "&#9888;"
    "â³"      = ""
    "â„¹ï¸"   = "&#8505;"
    "â­"      = "&#9733;"
    "âš¡"     = "&#9889;"
    "â˜€"     = "&#9728;"
    "Â·"      = "&middot;"
    "ðŸ'³"    = "&#128179;"
    "ðŸ§ "    = "&#129504;"
    "ðŸ"'"    = "&#128274;"
    "ðŸ'¬"    = "&#128172;"
    "ðŸ¤–"    = ""
    "ðŸ"©"    = ""
    "ðŸš€"    = ""
}

foreach ($old in $replacements.Keys) {
    $new = $replacements[$old]
    $content = $content.Replace($old, $new)
}

$utf8NoBom = New-Object System.Text.UTF8Encoding $false
[System.IO.File]::WriteAllText($filePath, $content, $utf8NoBom)

Write-Host "Done! welcome.blade.php re-encoded to UTF-8 and mojibake fixed." -ForegroundColor Green
