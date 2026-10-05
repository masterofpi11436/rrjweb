from gpiozero import Button, OutputDevice
from signal import pause
from threading import Timer


# --------------------------------------------------
# SETTINGS
# --------------------------------------------------

WATER_RUN_TIME = 30
FLUSH_RUN_TIME = 5


# --------------------------------------------------
# CELL 1
# Replace GPIO numbers as necessary
# --------------------------------------------------

cell_1_hot_button = Button(4, pull_up=True, bounce_time=0.05)
cell_1_cold_button = Button(17, pull_up=True, bounce_time=0.05)
cell_1_flush_button = Button(22, pull_up=True, bounce_time=0.05)

cell_1_hot_relay = OutputDevice(
    18,
    active_high=False,
    initial_value=False
)

cell_1_cold_relay = OutputDevice(
    27,
    active_high=False,
    initial_value=False
)

cell_1_flush_relay = OutputDevice(
    23,
    active_high=False,
    initial_value=False
)


# --------------------------------------------------
# CELL 2
# Replace GPIO numbers as necessary
# --------------------------------------------------

cell_2_hot_button = Button(5, pull_up=True, bounce_time=0.05)
cell_2_cold_button = Button(6, pull_up=True, bounce_time=0.05)
cell_2_flush_button = Button(13, pull_up=True, bounce_time=0.05)

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
#
# Eventually Laravel will control these.
# --------------------------------------------------

cell_1_enabled = True
cell_2_enabled = True


# --------------------------------------------------
# RELAY CONTROL
# --------------------------------------------------

def activate_relay(relay, duration, cell_enabled):

    if not cell_enabled:
        print("Water control denied - cell disabled.")
        return

    # Ignore another button press while the valve
    # is already running.
    if relay.value:
        return

    relay.on()

    Timer(
        duration,
        relay.off
    ).start()


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
    activate_relay(
        cell_1_flush_relay,
        FLUSH_RUN_TIME,
        cell_1_enabled
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
    activate_relay(
        cell_2_flush_relay,
        FLUSH_RUN_TIME,
        cell_2_enabled
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
