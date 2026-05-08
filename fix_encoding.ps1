# fix_encoding.ps1
# Re-encodes script.js from Windows-1252 to UTF-8 and cleans up all mojibake symbols
# Run from: c:\Users\swaya\OneDrive\Documents\harbour-tech\

$filePath = ".\script.js"

# Read file as Windows-1252 (Latin-1) since that's how it was saved
$content = [System.IO.File]::ReadAllText($filePath, [System.Text.Encoding]::GetEncoding(1252))

# Fix mojibake character sequences (Windows-1252 misread as UTF-8)
$replacements = @{
    # Em dashes
    "â€""     = "--"
    # Rupee sign
    "â‚¹"     = "&#8377;"
    # Right arrow
    "â†'"     = "&#8594;"
    # Bullet
    "â€¢"     = "&bull;"
    # Check mark sequences
    "âœ…"     = "&#10003;"
    "âœ•"     = "&#10005;"
    "âŒ"      = "&#10007;"
    # Warning
    "âš ï¸"   = "&#9888;"
    # Hourglass
    "â³"      = ""
    # Info
    "â„¹ï¸"   = "&#8505;"
    # Star
    "â­"      = "&#9733;"
    # Lightning
    "âš¡"     = "&#9889;"
    # Sun
    "â˜€"     = "&#9728;"
    # Middle dot (broken)
    "Â·"      = "&middot;"
    # Emoji mojibake (credit card, brain, lock, etc.)
    "ðŸ'³"    = "&#128179;"
    "ðŸ§ "    = "&#129504;"
    "ðŸ"'"    = "&#128274;"
    "ðŸ'¬"    = "&#128172;"
    "ðŸ'°"    = ""
    "â±ï¸"    = ""
    "âš™ï¸"   = ""
    "â˜ï¸"    = ""
    "ðŸ¤–"    = ""
    "ðŸ"©"    = ""
    "ðŸ›¡ï¸"  = ""
    "ðŸ'‹"    = ""
    "ðŸ˜Š"    = ""
    "ðŸš€"    = ""
    "ðŸ"Š"    = ""
    "ðŸ'¥"    = ""
    "ðŸ'°"    = ""
    "ðŸ› ï¸"  = ""
    "ðŸ¢"    = ""
    "ðŸ"ž"    = ""
    "ðŸ'³"    = "&#128179;"
}

foreach ($old in $replacements.Keys) {
    $new = $replacements[$old]
    $content = $content.Replace($old, $new)
}

# Write back as UTF-8 without BOM
$utf8NoBom = New-Object System.Text.UTF8Encoding $false
[System.IO.File]::WriteAllText($filePath, $content, $utf8NoBom)

Write-Host "Done! script.js has been re-encoded to UTF-8 and all mojibake symbols fixed." -ForegroundColor Green
