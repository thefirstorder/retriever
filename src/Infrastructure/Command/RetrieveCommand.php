<?php
declare(strict_types=1);

namespace Retriever\Infrastructure\Command;

use Retriever\Application\Retriever;
use Retriever\Application\Saver;
use Retriever\Domain\DocumentRequest\UrlDocumentRequest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RetrieveCommand extends Command
{
    protected static $defaultName = 'retrieve';

    /** @var Retriever */
    private $retriever;

    public function __construct(Retriever $retriever, Saver $saver)
    {
        $this->retriever = $retriever;
        $this->saver = $saver;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Retrieves a document from the Web')
            ->setHelp('It allows you to request any publicly available online resource.')
            ->addArgument('uri', InputArgument::REQUIRED, 'Uri to retrieve')
            ->addArgument('save', InputArgument::OPTIONAL, 'save results to local db')
            ->addOption(
                'include-metadata',
                'i',
                InputOption::VALUE_NONE,
                'Include the Document Metadata in the output'
            );
            
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $uri = $input->getArgument('uri');
        $fetchedDocument = $this->retriever->retrieve(new UrlDocumentRequest($uri));

        if ($input->getOption('include-metadata')) {
            $this->outputDocumentMetadata($output, $fetchedDocument);
        }
        
        $content = $fetchedDocument->getDocumentContent();
        if ($input->getArgument('save')) {
            $this->saver->save($uri, $fetchedDocument);
        }
        $output->write($content);
    }

    /**
     * @param OutputInterface $output
     * @param $fetchedDocument
     */
    protected function outputDocumentMetadata(OutputInterface $output, $fetchedDocument): void
    {
        foreach ($fetchedDocument->getMetadata()->getArrayCopy() as $key => $values) {
            $output->writeln("$key: ".implode(', ', $values));
        }
        $output->writeln('');
    }
}
