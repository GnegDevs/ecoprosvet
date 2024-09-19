package com.gnegdev.ecoprosvetcore.controllers;


import com.gnegdev.ecoprosvetcore.tools.db.EventRepositoryImpl;
import com.gnegdev.ecoprosvetcore.tools.db.EventRequest;
import com.gnegdev.ecoprosvetcore.tools.parser.ParserClient;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;
import java.io.IOException;
import java.util.ArrayList;

@RestController
@RequestMapping("ecocore/api/v1/parsemosru")
public class ParserController {
    private final EventRepositoryImpl eventRepository;
    public ParserController(EventRepositoryImpl eventRepository) {
        this.eventRepository = eventRepository;
    }
    @GetMapping("/{page}")
    public ResponseEntity<Integer> parseMosRuNews(@PathVariable int page) throws IOException {

        ArrayList<EventRequest> events = ParserClient.parseMosRuNews(page);
        for (EventRequest event : events) {
            eventRepository.insertEvent(event);
        }

        return ResponseEntity.status(HttpStatus.OK).body(200);
    }
}
