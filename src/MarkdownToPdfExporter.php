<?php

declare(strict_types=1);

namespace ikarolaborda\mdtopdf;
require 'vendor/autoload.php';
use Parsedown;
use Dompdf\Dompdf;
use Dompdf\Options;
use InvalidArgumentException;

class MarkdownToPdfExporter
{
    private Parsedown $parser;
    private Dompdf $pdfGenerator;

    public function __construct()
    {
        $this->parser = new Parsedown();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $this->pdfGenerator = new Dompdf($options);
    }

    public function exportToPdf(string $inputFile, string $outputFile): void
    {
        if (!file_exists($inputFile)) {
            throw new InvalidArgumentException("Input file does not exist: $inputFile");
        }

        $markdownContent = file_get_contents($inputFile);
        if ($markdownContent === false) {
            throw new InvalidArgumentException("Failed to read input file: $inputFile");
        }

        $html = $this->convertMarkdownToHtml($markdownContent);
        $this->generatePdf($html, $outputFile);
    }

    private function convertMarkdownToHtml(string $markdownContent): string
    {
        return $this->parser->text($markdownContent);
    }

    private function generatePdf(string $html, string $outputFilePath): void
    {
        $this->pdfGenerator->loadHtml($html);
        $this->pdfGenerator->setPaper('A4', 'portrait');
        $this->pdfGenerator->render();

        $output = $this->pdfGenerator->output();
        if (file_put_contents($outputFilePath, $output) === false) {
            throw new InvalidArgumentException("Failed to write to output file: $outputFilePath");
        }
    }
}

// CLI argument handling
if (php_sapi_name() !== 'cli') {
    exit('This script should be run from the command line.');
}

if ($argc !== 3) {
    echo "Usage: php " . $argv[0] . " <input_markdown_file> <output_pdf_file>\n";
    exit(1);
}

$inputFile = $argv[1];
$outputFile = $argv[2];

try {
    $exporter = new MarkdownToPdfExporter();
    $exporter->exportToPdf($inputFile, $outputFile);
    echo "PDF successfully generated: $outputFile\n";
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}