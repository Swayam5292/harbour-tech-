# fix_all_encoding.ps1
# Master script: fixes encoding on ALL website files in the Harbour Tech project
# Run this from: c:\Users\swaya\OneDrive\Documents\harbour-tech\

$replacements = @{
    "â€""     = "--"
    "â€˜"     = "'"
    "â€™"     = "'"
    "â€œ"     = '"'
    "â€"      = '"'
    "â‚¹"     = "&#8377;"
    "â†'"     = "&#8594;"
    "â†'"     = "&#8592;"
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
    "â˜ï¸"    = ""
    "Â·"      = "&middot;"
    "ðŸ'³"    = "&#128179;"
    "ðŸ§ "    = "&#129504;"
    "ðŸ"'"    = "&#128274;"
    "ðŸ'¬"    = "&#128172;"
    "ðŸ'°"    = ""
    "â±ï¸"    = ""
    "âš™ï¸"   = ""
    "ðŸ¤–"    = ""
    "ðŸ"©"    = ""
    "ðŸ›¡ï¸"  = ""
    "ðŸ'‹"    = ""
    "ðŸ˜Š"    = ""
    "ðŸš€"    = ""
    "ðŸ"Š"    = ""
    "ðŸ'¥"    = ""
    "ðŸ› ï¸"  = ""
    "ðŸ¢"     = ""
    "ðŸ"ž"    = ""
    "ðŸ'¡"    = ""
    "ðŸ¤"     = ""
    "ðŸ"‹"    = ""
    "ðŸ†"     = ""
    "ðŸŽ¯"    = ""
    "ðŸ§©"    = ""
    "ðŸ"µ"    = ""
    "ðŸ'"     = ""
    "ðŸ"ˆ"    = ""
}

$filePatterns = @("*.js", "*.html", "*.css", "*.php", "*.blade.php", "*.json")

$files = @()
foreach ($pattern in $filePatterns) {
    $files += Get-ChildItem -Path "." -Filter $pattern -Recurse -ErrorAction SilentlyContinue |
              Where-Object { $_.FullName -notmatch "\\vendor\\" -and $_.FullName -notmatch "\\.git\\" -and $_.FullName -notmatch "\\node_modules\\" }
}

$fixedCount = 0
foreach ($file in $files) {
    try {
        $content = [System.IO.File]::ReadAllText($file.FullName, [System.Text.Encoding]::GetEncoding(1252))
        $original = $content
        foreach ($old in $replacements.Keys) {
            $new = $replacements[$old]
            $content = $content.Replace($old, $new)
        }
        if ($content -ne $original) {
            $utf8NoBom = New-Object System.Text.UTF8Encoding $false
            [System.IO.File]::WriteAllText($file.FullName, $content, $utf8NoBom)
            Write-Host "Fixed: $($file.Name)" -ForegroundColor Yellow
            $fixedCount++
        }
    } catch {
        Write-Host "Skipped (binary or locked): $($file.Name)" -ForegroundColor Gray
    }
}

Write-Host "`nDone! Fixed $fixedCount files. All encoding issues resolved." -ForegroundColor Green
