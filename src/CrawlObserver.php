<?php

namespace Spatie\Crawler;

use Psr\Http\Message\UriInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\RequestException;
use Spatie\Browsershot\Browsershot;

abstract class CrawlObserver
{
    /**
     * @var \Spatie\Browsershot\Browsershot
     */
    protected $browsershot;

    /**
     * @var CrawlQueue\CrawlQueue
     */
    protected $crawlQueue;

    /**
     * @return \Spatie\Browsershot\Browsershot
     */
    public function getBrowsershot()
    {
        return $this->browsershot;
    }

    /**
     * @param \Spatie\Browsershot\Browsershot $browsershot
     *
     * @return \Spatie\Crawler\CrawlObserver
     */
    public function setBrowsershot(Browsershot $browsershot)
    {
        $this->browsershot = $browsershot;

        return $this;
    }

    /**
     * Called when the crawler will crawl the url.
     *
     * @param \Psr\Http\Message\UriInterface $url
     */
    public function willCrawl(UriInterface $url)
    {
    }

    /**
     * Called when the crawler has crawled the given url successfully.
     *
     * @param \Psr\Http\Message\UriInterface $url
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param \Psr\Http\Message\UriInterface|null $foundOnUrl
     */
    abstract public function crawled(
        UriInterface $url,
        ResponseInterface $response,
        ?UriInterface $foundOnUrl = null
    );

    /**
     * Called when the crawler had a problem crawling the given url.
     *
     * @param \Psr\Http\Message\UriInterface $url
     * @param \GuzzleHttp\Exception\RequestException $requestException
     * @param \Psr\Http\Message\UriInterface|null $foundOnUrl
     */
    abstract public function crawlFailed(
        UriInterface $url,
        RequestException $requestException,
        ?UriInterface $foundOnUrl = null
    );

    /**
     * Called when the crawl has ended.
     */
    public function finishedCrawling()
    {
    }

    /**
     * @param CrawlQueue\CrawlQueue $crawlQueue
     *
     * @return CrawlObserver
     */
    public function setCrawlQueue(CrawlQueue\CrawlQueue $crawlQueue)
    {
        $this->crawlQueue = $crawlQueue;

        return $this;
    }

    /**
     * @return \Spatie\Crawler\CrawlQueue\CrawlQueue
     */
    public function getCrawlQueue()
    {
        return $this->crawlQueue;
    }
}
