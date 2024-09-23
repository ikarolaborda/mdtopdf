# Markdown to PDF Exporter
This PHP script converts Markdown files to PDF documents using command-line arguments. It utilizes the Parsedown library for Markdown parsing and Dompdf for PDF generation.

## Features
Converts Markdown files to PDF format
Accepts input and output file paths as command-line arguments
Handles errors gracefully with informative messages
Uses PHP 8.3 features and follows object-oriented programming principles

## Requirements

 - PHP 8.2 or higher
- Composer for dependency management

## Installation

Install using Composer:
```bash
composer require ikarolaborda/mdtopdf
```

## Usage
Run the script from the command line, providing the input Markdown file and the desired output PDF file as arguments:
```bash
php vendor/bin/ikarolaborda/MarkdownToPdfExporter.php <input_markdown_file> <output_pdf_file>
```
Example:

```bash
php vendor/bin/ikarolaborda/MarkdownToPdfExporter.php input.md output.pdf
```
If successful, you'll see a message confirming that the PDF was generated.

## Error Handling
The script includes error handling for common issues:

- If the input file doesn't exist, an error message will be displayed.
- If there are issues reading the input file or writing the output file, appropriate error messages will be shown.
- If the incorrect number of arguments is provided, usage instructions will be displayed.

## Customization
- You can modify the MarkdownToPdfExporter class to customize the PDF output (By extending it):

- Adjust the paper size and orientation in the generatePdf method.
- Modify the Dompdf options in the constructor for different PDF settings.

## Contributing
Contributions are welcome! Please feel free to submit a Pull Request.
## License
This project is open source and available under the MIT License.
## Support
If you encounter any problems or have any questions, please open an issue in this GitHub repository.