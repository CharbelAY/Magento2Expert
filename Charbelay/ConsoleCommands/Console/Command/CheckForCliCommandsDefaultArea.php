<?php
/**
 * @copyright Copyright (c) 2023 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit <info@magebit.com>
 * @license   MIT
 */

declare(strict_types=1);

namespace Charbelay\ConsoleCommands\Console\Command;

use Magento\Framework\Exception\LocalizedException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Framework\App\State;

class CheckForCliCommandsDefaultArea extends Command
{
    private State $state;

    public function __construct(State $state, string $name = null)
    {
        $this->state = $state;
        parent::__construct($name);
    }

    /**
     * Initialization of the command.
     */
    protected function configure()
    {
        $this->setName('show:cli:default:area');
        $this->setDescription('Show the cli default area');
        $this->addOption('shouldSayHello','ssh',InputOption::VALUE_OPTIONAL);
        parent::configure();
    }

    /**
     * CLI command description.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $exitCode = 0;

        $shouldSayHello = $input->getOption('shouldSayHello');
        if ($shouldSayHello) {
            $output->writeln(sprintf('<comment>%s</comment>', 'Hello'));

            return 1;
        }


        try {
            $area = $this->state->getAreaCode();
            $output->writeln(sprintf('<info>%s</info>', $area));

            return 1;
        } catch (LocalizedException $e) {
            $output->writeln(sprintf('<error>%s</error>', $e->getMessage()));
        }


        return $exitCode;
    }
}
