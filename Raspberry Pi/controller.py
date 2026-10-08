
from gpiozero import Button, OutputDevice
from signal import pause
from threading import Timer, Lock
from collections import deque
from time import monotonic


# --------------------------------------------------
# SETTINGS
# --------------------------------------------------

WATER_RUN_TIME = 30
FLUSH_RUN_TIME = 2

DEFAULT_FLUSH_LIMIT = 3
FLUSH_WINDOW = 60 * 60

cell_1_flush_limit = DEFAULT_FLUSH_LIMIT
cell_2_flush_limit = DEFAULT_FLUSH_LIMIT


# --------------------------------------------------
# CELL 1 BUTTONS
# --------------------------------------------------

cell_1_hot_button = Button(17, pull_up=True, bounce_time=0.05)
cell_1_cold_button = Button(27, pull_up=True, bounce_time=0.05)
cell_1_flush_button = Button(22, pull_up=True, bounce_time=0.05)


# --------------------------------------------------
# CELL 1 RELAYS
# --------------------------------------------------

cell_1_hot_relay = OutputDevice(
    18,
    active_high=False,
    initial_value=False
)

cell_1_cold_relay = OutputDevice(
    23,
    active_high=False,
    initial_value=False
)

cell_1_flush_relay = OutputDevice(
    24,
    active_high=False,
    initial_value=False
)


# --------------------------------------------------
# CELL 2 BUTTONS
# --------------------------------------------------

cell_2_hot_button = Button(5, pull_up=True, bounce_time=0.05)
cell_2_cold_button = Button(6, pull_up=True, bounce_time=0.05)
cell_2_flush_button = Button(13, pull_up=True, bounce_time=0.05)


# --------------------------------------------------
# CELL 2 RELAYS
# --------------------------------------------------

cell_2_hot_relay = OutputDevice(
    19,
    active_high=False,
    initial_value=False
)

cell_2_cold_relay = OutputDevice(
    26,
    active_high=False,
    initial_value=False
)

cell_2_flush_relay = OutputDevice(
    21,
    active_high=False,
    initial_value=False
)


# --------------------------------------------------
# CELL ENABLE / DISABLE STATE
# Future Laravel control
# --------------------------------------------------

cell_1_enabled = True
cell_2_enabled = True


# --------------------------------------------------
# RELAY LOCKS AND ACTIVE STATES
# --------------------------------------------------

relay_states = {}

all_relays = [
    cell_1_hot_relay,
    cell_1_cold_relay,
    cell_1_flush_relay,
    cell_2_hot_relay,
    cell_2_cold_relay,
    cell_2_flush_relay
]

for relay in all_relays:
    relay_states[relay] = {
        "lock": Lock(),
        "active": False
    }

# --------------------------------------------------
# HOURLY FLUSH TRACKING
# --------------------------------------------------

flush_history = {
    1: deque(),
    2: deque()
}

flush_locks = {
    1: Lock(),
    2: Lock()
}


def activate_flush(cell_number, relay, enabled, limit):

    if not enabled:
        print(f"Cell {cell_number} is disabled.")
        return

    with flush_locks[cell_number]:

        now = monotonic()
        history = flush_history[cell_number]

        # Remove flushes older than 60 minutes
        while history and now - history[0] >= FLUSH_WINDOW:
            history.popleft()

        if len(history) >= limit:
            print(
                f"Cell {cell_number}: Hourly flush limit reached."
            )
            return

        # Only count a flush if the relay starts
        if activate_relay(relay, FLUSH_RUN_TIME, enabled):
            history.append(now)

            print(
                f"Cell {cell_number}: "
                f"{len(history)}/{limit} flushes used."
            )


# --------------------------------------------------
# RELAY CONTROL WITH TIMER PROTECTION
# --------------------------------------------------

def activate_relay(relay, duration, cell_enabled):

    if not cell_enabled:
        print("Water control denied - cell disabled.")
        return False

    state = relay_states[relay]

    with state["lock"]:

        if state["active"]:
            print("Relay already active.")
            return False

        state["active"] = True

        try:
            relay.on()

            def stop_relay():
                with state["lock"]:
                    try:
                        relay.off()
                    finally:
                        state["active"] = False

            timer = Timer(duration, stop_relay)
            timer.daemon = True
            timer.start()

            return True

        except Exception:
            try:
                relay.off()
            finally:
                state["active"] = False
            raise

    def stop_relay():

        with state["lock"]:
            try:
                relay.off()
            finally:
                state["active"] = False

    try:
        timer = Timer(duration, stop_relay)
        timer.daemon = True
        timer.start()

    except Exception:
        stop_relay()
        raise


# --------------------------------------------------
# CELL 1
# --------------------------------------------------

def cell_1_hot():
    activate_relay(
        cell_1_hot_relay,
        WATER_RUN_TIME,
        cell_1_enabled
    )


def cell_1_cold():
    activate_relay(
        cell_1_cold_relay,
        WATER_RUN_TIME,
        cell_1_enabled
    )


def cell_1_flush():
    activate_flush(
        1,
        cell_1_flush_relay,
        cell_1_enabled,
        cell_1_flush_limit
    )


# --------------------------------------------------
# CELL 2
# --------------------------------------------------

def cell_2_hot():
    activate_relay(
        cell_2_hot_relay,
        WATER_RUN_TIME,
        cell_2_enabled
    )


def cell_2_cold():
    activate_relay(
        cell_2_cold_relay,
        WATER_RUN_TIME,
        cell_2_enabled
    )


def cell_2_flush():
    activate_flush(
        2,
        cell_2_flush_relay,
        cell_2_enabled,
        cell_2_flush_limit
    )


# --------------------------------------------------
# BUTTON EVENTS
# --------------------------------------------------

cell_1_hot_button.when_pressed = cell_1_hot
cell_1_cold_button.when_pressed = cell_1_cold
cell_1_flush_button.when_pressed = cell_1_flush

cell_2_hot_button.when_pressed = cell_2_hot
cell_2_cold_button.when_pressed = cell_2_cold
cell_2_flush_button.when_pressed = cell_2_flush


# --------------------------------------------------
# START
# --------------------------------------------------

print("Water controller started.")

pause()
