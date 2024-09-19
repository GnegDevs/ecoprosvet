package com.gnegdev.ecoprosvetcore.controllers;

import com.gnegdev.ecoprosvetcore.tools.db.Event;
import com.gnegdev.ecoprosvetcore.tools.db.EventRepositoryImpl;
import com.gnegdev.ecoprosvetcore.tools.db.EventRequest;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.Optional;

@RestController
@RequestMapping("ecocore/api/v1/event")
public class EventController {
    private final EventRepositoryImpl eventRepository;
    public EventController(EventRepositoryImpl eventRepository) {
        this.eventRepository = eventRepository;
    }


    @GetMapping("/ping")
    @ResponseStatus(HttpStatus.OK)
    public String ping() {
        return "ok";
    }

    @GetMapping("/{id}")
    @ResponseBody
    public ResponseEntity<Object> getEventById(@PathVariable int id) {
        Optional<Event> event = eventRepository.getEventById(id);
        if (event.isEmpty()) {
            return ResponseEntity.status(HttpStatus.NOT_FOUND).body("Event with id = " + id + " not found");
        }
        return ResponseEntity.status(HttpStatus.OK).body(event);
    }

    @GetMapping()
    @ResponseBody
    public ResponseEntity<Object> getEvents() {
        return ResponseEntity.ok(eventRepository.getEvents());
    }

    @PostMapping("/create")
    @ResponseBody
    public ResponseEntity<Integer> insertEvent(@RequestBody EventRequest eventForm) {
        eventRepository.insertEvent(eventForm);
        return ResponseEntity.status(HttpStatus.CREATED).body(201);
    }
}